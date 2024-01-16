@extends('layouts.adminlte')

@section('javascript')
    <script>
        $("#datatable").DataTable({
            "responsive": true,
            "autoWidth": false,
        });

        $("#datatable2").DataTable({
            "responsive": true,
            "autoWidth": false,
        });

        function modalEditPelamar(lowonganId, userEmail) {
            $.ajax({
                type: 'POST',
                url: '{{ route('lamaran.getEditForm') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'lowongans_id': lowonganId,
                    'users_email': userEmail,
                },
                success: function(data) {
                    $("#modalContent").html(data.msg);
                },
                error: function(xhr) {
                    console.log(xhr);
                }
            });


        }

        function showriwayat(email) {

            $.ajax({
                type: 'POST',
                url: '{{ route('lamaran.showRiwayat') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'users_email': email,
                },
                success: function(data) {
                    $("#modalContent2").html(data.msg);
                },
                error: function(xhr) {
                    console.log(xhr);
                }
            });
        }

        $('#myTable').dataTable({
            "order": [3, 'desc']
        });


        function onChangeStatus(val, status) {
            // Get all checkbox elements
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');

            if (status == 'Tahap Seleksi') {
                var keteranganSeleksi = document.getElementById("keteranganSeleksi");
                if (val == 'Diterima') {
                    keteranganSeleksi.style.display = "none";
                    // Loop through each checkbox and uncheck it
                    checkboxes.forEach(function(checkbox) {
                        checkbox.checked = false;
                    });
                }
                if (val == 'Tidak Lolos Seleksi') {
                    keteranganSeleksi.style.display = "block";
                }
                if (val == "") {
                    keteranganSeleksi.style.display = "none";
                    // Loop through each checkbox and uncheck it
                    checkboxes.forEach(function(checkbox) {
                        checkbox.checked = false;
                    });
                }
            } else {
                var hideKet = document.getElementById("hideKet");
                if (val == 'Tidak Lolos Seleksi') {
                    hideKet.removeAttribute("hidden");
                } else {
                    hideKet.setAttribute("hidden", true);
                    // Loop through each checkbox and uncheck it
                    checkboxes.forEach(function(checkbox) {
                        checkbox.checked = false;
                    });
                }
            }

        }
    </script>
@endsection

@section('title')
    Show Pelamar
@endsection

@section('contents')
    <div class="container">
        @if (\Session::has('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
            Swal.fire({
                icon: 'success', // Ganti dengan 'success', 'error', 'warning', atau 'info' sesuai kebutuhan Anda
                title: 'Berhasil !',
                text:'{!! \Session::get('success') !!}'
            });
        </script>
        @endif

        @php
            $lamaran = $lamarans;
        @endphp

        @php
            $j = 0;
            //Fungsi Untuk menentukan nilai dari tingkat pendidikan
            function nilaiKualifikasi($tingkat_pendidikan)
            {
                $nilai = 0;
                if ($tingkat_pendidikan == 'SD Sederajat') {
                    $nilai = 1;
                } elseif ($tingkat_pendidikan == 'SMP Sederajat') {
                    $nilai = 2;
                } elseif ($tingkat_pendidikan == 'SMA Sederajat') {
                    $nilai = 3;
                } elseif ($tingkat_pendidikan == 'SMK Sederajat') {
                    $nilai = 4;
                } elseif ($tingkat_pendidikan == 'D1/D2/D3/D4') {
                    $nilai = 5;
                } elseif ($tingkat_pendidikan == 'Sarjana(Strata-1)') {
                    $nilai = 6;
                } elseif ($tingkat_pendidikan == 'Pasca Sarjana') {
                    $nilai = 7;
                }
                return $nilai;
            }
        @endphp


        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                    aria-controls="home" aria-selected="true">Sesuai Kualifikasi & Kompeten</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                    aria-controls="profile" aria-selected="false">Sesuai Kualifikasi & Tidak Kompeten</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                    aria-controls="contact" aria-selected="false">Tidak Sesuai Kualifikasi</a>
            </li>
        </ul>

        <div class="tab-content mt-4" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <h3>Sesuai Kualifikasi Administrasi dan Kompeten</h3>
                <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable"
                    role="grid" aria-describedby="sample_1_info">
                    <thead>
                        <tr role="row">
                            <th>Nama</th>
                            <th>Tanggal Melamar</th>
                            <th>Status</th>
                            <th>Kompetensi</th>
                            <th>Pendidikan Terakhir</th>
                            <th>Tanggal Update Status</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lamarans as $pelamar)
                            @for ($i = 0; $i < count($pelatihans); $i++)
                                @if ($pelatihans[$i] != null)
                                    @if (
                                        $pelatihans[$i]->email_peserta == $pelamar->users_email &&
                                            nilaiKualifikasi($users[$i]->pendidikan_terakhir) >= nilaiKualifikasi($lowongan->pendidikan_terakhir))
                                        @if ($pelatihans[$i]->hasil_kompetensi == 'KOMPETEN')
                                            <tr>
                                                <td>{{ $users[$i]->nama_depan }} {{ $users[$i]->nama_belakang }}</td>
                                                <td>{{ $pelamar->tanggal_pelamaran }}</td>
                                                <td>{{ $pelamar->status }}</td>
                                                @if ($pelatihans[$i]->hasil_kompetensi == null)
                                                    <td>-</td>
                                                @else
                                                    <td>{{ $pelatihans[$i]->hasil_kompetensi }}</td>
                                                @endif
                                                <td>{{ $users[$i]->pendidikan_terakhir }}</td>
                                                <td>{{ $pelamar->updated_at }}</td>
                                                <td>{{ $pelamar->keterangan }}</td>

                                                <td>
                                                    @if ($pelamar->status == 'Diterima' || $pelamar->status == 'Tidak Lolos Seleksi')
                                                        <a data-toggle="modal" data-target="#modalEditPelamar"
                                                            class='btn btn-warning'
                                                            onclick="modalEditPelamar({{ $pelamar->lowongans_id }},'{{ $pelamar->users_email }}')">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    @else
                                                        <a data-toggle="modal" data-target="#modalEditPelamar"
                                                            class='btn btn-warning'
                                                            onclick="modalEditPelamar({{ $pelamar->lowongans_id }},'{{ $pelamar->users_email }}')">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                    @endif

                                                    <button data-toggle="modal" data-target="#showRiwayat" type="button"
                                                        class="btn btn-info"
                                                        onclick="showriwayat('{{ $pelamar->users_email }}')">
                                                        <i class="fas fa-history"></i> Riwayat
                                                    </button>
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                @endif
                            @endfor
                        @endforeach
                    </tbody>
                </table><br>

            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <h3>Sesuai Kualifikasi Administrasi dan Tidak Kompeten</h3>
                <table class="table table-striped table-bordered table-hover dataTable no-footer" id="datatable"
                    role="grid" aria-describedby="sample_1_info">
                    <thead>
                        <tr role="row">
                            <th>Nama</th>
                            <th>Tanggal Melamar</th>
                            <th>Status</th>
                            <th>Kompetensi</th>
                            <th>Pendidikan Terakhir</th>
                            <th>Tanggal Update Status</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lamarans as $pelamar)
                            @for ($i = 0; $i < count($pelatihans); $i++)
                                @if ($pelatihans[$i] != null)
                                    @if (
                                        $pelatihans[$i]->email_peserta == $pelamar->users_email &&
                                            nilaiKualifikasi($users[$i]->pendidikan_terakhir) >= nilaiKualifikasi($lowongan->pendidikan_terakhir))
                                        @if ($pelatihans[$i]->hasil_kompetensi != 'KOMPETEN')
                                            <tr>
                                                <td>{{ $users[$i]->nama_depan }} {{ $users[$i]->nama_belakang }}</td>
                                                <td>{{ $pelamar->tanggal_pelamaran }}</td>
                                                <td>{{ $pelamar->status }}</td>
                                                @if ($pelatihans[$i]->hasil_kompetensi == null)
                                                    <td>-</td>
                                                @else
                                                    <td>{{ $pelatihans[$i]->hasil_kompetensi }}</td>
                                                @endif
                                                <td>{{ $users[$i]->pendidikan_terakhir }}</td>
                                                <td>{{ $pelamar->updated_at }}</td>
                                                <td>{{ $pelamar->keterangan }}</td>

                                                <td>
                                                    @if ($pelamar->status == 'Diterima' || $pelamar->status == 'Tidak Lolos Seleksi')
                                                        <a data-toggle="modal" data-target="#modalEditPelamar"
                                                            class='btn btn-warning'
                                                            onclick="modalEditPelamar({{ $pelamar->lowongans_id }},'{{ $pelamar->users_email }}')">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    @else
                                                        <a data-toggle="modal" data-target="#modalEditPelamar"
                                                            class='btn btn-warning'
                                                            onclick="modalEditPelamar({{ $pelamar->lowongans_id }},'{{ $pelamar->users_email }}')">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                    @endif

                                                    <button data-toggle="modal" data-target="#showRiwayat" type="button"
                                                        class="btn btn-info"
                                                        onclick="showriwayat('{{ $pelamar->users_email }}')">
                                                        <i class="fas fa-history"></i> Riwayat
                                                    </button>
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                @endif
                            @endfor
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <h3>Tidak Sesuai Kualifikasi Administrasi</h3>
                <table class="table table-striped table-bordered table-hover dataTable no-footer" id="datatable2"
                    role="grid" aria-describedby="sample_1_info">
                    <thead>
                        <tr role="row">
                            <th>Nama</th>
                            <th>Tanggal Melamar</th>
                            <th>Status</th>
                            <th>Kompetensi</th>
                            <th>Pendidikan Terakhir</th>
                            <th>Tanggal Update Status</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lamarans as $pelamar)
                            @for ($i = 0; $i < count($pelatihans); $i++)
                                @if ($pelatihans[$i] != null)
                                    @if (
                                        $pelatihans[$i]->email_peserta == $pelamar->users_email &&
                                            nilaiKualifikasi($users[$i]->pendidikan_terakhir) < nilaiKualifikasi($lowongan->pendidikan_terakhir))
                                        <tr>
                                            <td>{{ $users[$i]->nama_depan }} {{ $users[$i]->nama_belakang }}</td>
                                            <td>{{ $pelamar->tanggal_pelamaran }}</td>
                                            <td>{{ $pelamar->status }}</td>

                                            @if ($pelatihans[$i]->hasil_kompetensi == null)
                                                <td>-</td>
                                            @else
                                                <td>{{ $pelatihans[$i]->hasil_kompetensi }}</td>
                                            @endif
                                            <td>{{ $users[$i]->pendidikan_terakhir }}</td>

                                            <td>{{ $pelamar->updated_at }}</td>
                                            <td>{{ $pelamar->keterangan }}</td>
                                            <td>
                                                @if ($pelamar->status == 'Diterima' || $pelamar->status == 'Tidak Lolos Seleksi')
                                                    <a data-toggle="modal" data-target="#modalEditPelamar"
                                                        class='btn btn-warning'
                                                        onclick="modalEditPelamar({{ $pelamar->lowongans_id }},'{{ $pelamar->users_email }}')">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @else
                                                    <a data-toggle="modal" data-target="#modalEditPelamar"
                                                        class='btn btn-warning'
                                                        onclick="modalEditPelamar({{ $pelamar->lowongans_id }},'{{ $pelamar->users_email }}')">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                @endif


                                                <button data-toggle="modal" data-target="#showRiwayat" type="button"
                                                    class="btn btn-info"
                                                    onclick="showriwayat('{{ $pelamar->users_email }}')">
                                                    <i class="fas fa-history"></i> Riwayat
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                @endif
                            @endfor
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>






    </div>
    {{-- Modal --}}
    <div class="modal fade" id="modalEditPelamar" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" id="modalContent">

        </div>
    </div>

    {{-- Modal Show Pelamar --}}
    <div class="modal fade showRiwayat" id="showRiwayat" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="modalContent2">
            </div>
        </div>
    </div>
@endsection
