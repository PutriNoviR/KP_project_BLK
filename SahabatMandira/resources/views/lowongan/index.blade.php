@extends('layouts.adminlte')

@section('title')
    Lowongan
@endsection

@section('javascript')
    <script>
        var table2 = $('#myTable2').DataTable({
            "responsive": true,
            "order": [
                [6, 'asc']
            ]
        });

        var table3 = $('#myTable3').DataTable({
            "responsive": true,
            "order": [
                [6, 'asc']
            ]
        });

        var table4 = $('#myTable4').DataTable({
            "responsive": true,
            "order": [
                [6, 'asc']
            ]
        });
    </script>

    <script>
        $(document).ready(function() {
            var table = $('#myTable').DataTable({
                "responsive": true
            });

            table.order([4, 'desc']).draw();

            // Loop through each row in the table
            table.rows().every(function(rowIdx, tableLoop, rowLoop) {
                var rowData = this.data();
                var deadline = new Date(rowData[6]);

                var countdownCell = table.cell(rowIdx, 8).node(); // Get the cell element

                // Update countdown every second
                var x = setInterval(function() {
                    var now = new Date().getTime();
                    // var now = new Date(rowData[5]).getTime();
                    // console.log(now);
                    var timeDiff = deadline - now;

                    var days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);

                    var countdown = days + 'Hari ' + hours + 'Jam ' + minutes + 'Menit ' + seconds +
                        'Detik';

                    // Set the countdown value in the third column of the row
                    countdownCell.textContent = countdown;
                    if (days < 2) {
                        countdownCell.style.display = 'block';
                        countdownCell.style.color = 'red';
                    }

                    // If the countdown is over, display a message and clear the interval
                    if (timeDiff < 0) {
                        clearInterval(x);
                        countdownCell.textContent = 'Time is up!';
                    }
                }, 1000); // Update every 1 second
            });
        });
    </script>
    <script>
        function submitDelete(form) {
            swal({
                    title: "Peringatan!",
                    text: "Apakah anda yakin ingin menghapus data ini?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
            return false;
        }
    </script>
@endsection


@section('contents')
    <script>
        function modalEdit(lowonganId) {
            $.ajax({
                type: 'POST',
                url: '{{ route('lowongan.getEdit') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': lowonganId
                },
                success: function(data) {
                    $("#modalContent").html(data.msg);
                    console.log(data);
                },
                error: function(xhr) {
                    alert('erorr');
                    console.log(xhr);
                }
            });
        }

        //VIEWWW
        function view(id) {
            $.ajax({
                type: 'POST',
                url: '{{ route('lowongan.view') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id
                },
                success: function(data) {
                    $("#modalContent2").html(data.msg);
                    console.log(data);
                },
                error: function(xhr) {
                    alert('erorr');
                    console.log(xhr);
                }
            });
        }

        //



    </script>

    <div class="container">
        <div class="d-flex justify-content-between mb-2">
            <h2>Daftar Lowongan {{ $perusahaan->nama }}</h2>

            <a class="btn btn-primary" href="{{ route('lowongan.create') }}">
                Tambah Lowongan
            </a>
        </div>


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

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="semua-tab" data-toggle="tab" href="#semua" role="tab"
                    aria-controls="semua" aria-selected="true">Semua Lowongan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="aktif-tab" data-toggle="tab" href="#aktif" role="tab"
                    aria-controls="aktif" aria-selected="false">Aktif</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tutup-tab" data-toggle="tab" href="#tutup" role="tab"
                    aria-controls="tutup" aria-selected="false">Tutup</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="kadaluarsa-tab" data-toggle="tab" href="#kadaluarsa" role="tab"
                    aria-controls="kadaluarsa" aria-selected="false">Kadaluarsa</a>
            </li>
        </ul>

        <div class="tab-content mt-4" id="myTabContent">
            <div class="tab-pane fade show active" id="semua" role="tabpanel" aria-labelledby="semua-tab">
                {{-- SEMUA LOWONGAN --}}
                <div class="container mt-4">
                    <div class="d-flex justify-content-around">
                        <div class="d-flex align-items-center">
                            <span class="badge badge-danger mr-2">&nbsp;</span>
                            <span>Lowongan Kadaluarsa</span>
                        </div>
                    </div>
                </div>
                {{-- ----- --}}
                <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable"
                    role="grid" aria-describedby="sample_1_info">
                    <thead>
                        <tr role="row">
                            <th>Nama Lowongan</th>
                            <th>Bidang Kerja</th>
                            <th>Posisi</th>
                            <th>Tempat Kerja</th>
                            <th>Tanggal Pemasangan</th>
                            <th>Tanggal Penutupan</th>
                            <th>Tanggal Penetapan</th>
                            <th style="width: 22%">Jumlah</th>
                            <th>Waktu Pengingat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">

                        @foreach ($data_lowongan as $d)
                            <tr
                                style="@if ($d->tanggal_kadaluarsa >= date('Y-m-d')) ; @else background-color: rgba(255, 0, 0, 0.5); @endif">
                                <td>{{ $d->nama }}</td>
                                <td>{{ $d->bidang_kerja->nama_bidang }} - {{ $d->bidang_kerja->keterangan }}</td>
                                <td>{{ $d->posisi }}</td>
                                <td>{{ $d->kota }}</td>
                                <td>{{ $d->tanggal_pemasangan }}</td>
                                <td>{{ $d->tanggal_kadaluarsa }}</td>
                                <td>{{ $d->tanggal_penetapan }}</td>

                                @php
                                    $terdaftar = 0;
                                    $diterima = 0;
                                    $seleksi = 0;
                                    $ditolak = 0;
                                    $total = 0;
                                @endphp
                                @foreach ($d->lamaran as $i)
                                    @php
                                        $total++;
                                    @endphp
                                    @if ($i->status == 'Terdaftar')
                                        @php
                                            $terdaftar++;
                                        @endphp
                                    @elseif($i->status == 'Diterima')
                                        @php
                                            $diterima++;
                                        @endphp
                                    @elseif($i->status == 'Tahap Seleksi')
                                        @php
                                            $seleksi++;
                                        @endphp
                                    @else
                                        @php
                                            $ditolak++;
                                        @endphp
                                    @endif
                                @endforeach

                                <td>
                                    <table style="width: 100%">
                                        <tr>
                                            <td colspan="2" style="text-align: center"><b>Pendaftar :
                                                    {{ $total }}</b>
                                            </td>
                                        </tr>
                                        <tr style="text-align: center">
                                            <td style="width: 50%"> Seleksi : {{ $seleksi }}</td>
                                            <td style="width: 50%"> Diterima : {{ $diterima }}</td>
                                        </tr>
                                        <tr style="text-align: center">
                                            <td style="width: 50%"> Ditolak : {{ $ditolak }}</td>
                                            <td style="width: 50%"> Terdaftar : {{ $terdaftar }}</td>
                                        </tr>
                                    </table>
                                </td>
                                <td class="countdown-cell"></td>

                                <td>
                                    <div class="text-center">
                                        <a class="btn btn-primary" href="{{ route('lamaran.show', $d->id) }}">
                                            <i class="fas fa-users"></i>
                                            Daftar Pelamar
                                        </a>

                                        @if ($d->tanggal_kadaluarsa >= date('Y-m-d H:i:s'))
                                            <a href="#modalEditLowongan" data-toggle="modal" class='btn btn-warning'
                                                onclick="modalEdit({{ $d->id }})">
                                                <i class="fas fa-pen"></i> Edit
                                            </a>
                                            <form method="POST" action="{{ route('lowongan.destroy', $d->id) }}"
                                                onsubmit="return submitDelete(this);" class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger" data-toggle="modal"
                                                    data-toggle="modal"><i class="fas fa-trash"></i> Hapus Lowongan
                                                </button>
                                            </form>
                                        @else
                                            <span class="badge badge-danger">Ditutup</span>
                                        @endif
                                        <a class="btn btn-success" href="{{ route('lowongan.log', $d->id) }}"> <i
                                                class="fas fa-clock"></i> Log</a>
                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                            data-target="#modalView" onclick="view({{ $d->id }})">
                                            <i class="fas fa-eye"></i>Lihat
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="aktif" role="tabpanel" aria-labelledby="aktif-tab">
                {{-- AKTIF --}}
                <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable2"
                    role="grid" aria-describedby="sample_1_info">
                    <thead>
                        <tr role="row">
                            <th>Nama Lowongan</th>
                            <th>Bidang Kerja</th>
                            <th>Posisi</th>
                            <th>Tempat Kerja</th>
                            <th>Tanggal Pemasangan</th>
                            <th>Tanggal Penutupan</th>
                            <th>Tanggal Penetapan</th>
                            <th style="width: 22%">Jumlah</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($data_lowongan as $d)
                            @if ($d->tanggal_kadaluarsa >= date('Y-m-d H:i:s'))
                                <tr>
                                    <td>{{ $d->nama }}</td>
                                    <td>{{ $d->bidang_kerja->nama_bidang }}</td>
                                    <td>{{ $d->posisi }}</td>
                                    <td>{{ $d->kota }}</td>
                                    <td>{{ $d->tanggal_pemasangan }}</td>
                                    <td>{{ $d->tanggal_kadaluarsa }}</td>
                                    <td>{{ $d->tanggal_penetapan }}</td>

                                    @php
                                        $terdaftar = 0;
                                        $diterima = 0;
                                        $seleksi = 0;
                                        $ditolak = 0;
                                        $total = 0;
                                    @endphp
                                    @foreach ($d->lamaran as $i)
                                        @php
                                            $total++;
                                        @endphp
                                        @if ($i->status == 'Terdaftar')
                                            @php
                                                $terdaftar++;
                                            @endphp
                                        @elseif($i->status == 'Diterima')
                                            @php
                                                $diterima++;
                                            @endphp
                                        @elseif($i->status == 'Tahap Seleksi')
                                            @php
                                                $seleksi++;
                                            @endphp
                                        @else
                                            @php
                                                $ditolak++;
                                            @endphp
                                        @endif
                                    @endforeach

                                    <td>
                                        <table style="width: 100%">
                                            <tr>
                                                <td colspan="2" style="text-align: center"><b>Pendaftar :
                                                        {{ $total }}</b>
                                                </td>
                                            </tr>
                                            <tr style="text-align: center">
                                                <td style="width: 50%"> Seleksi : {{ $seleksi }}</td>
                                                <td style="width: 50%"> Diterima : {{ $diterima }}</td>
                                            </tr>
                                            <tr style="text-align: center">
                                                <td style="width: 50%"> Ditolak : {{ $ditolak }}</td>
                                                <td style="width: 50%"> Terdaftar : {{ $terdaftar }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <a class="btn btn-primary" href="{{ route('lamaran.show', $d->id) }}">
                                                <i class="fas fa-users"></i>
                                                Daftar Pelamar
                                            </a>

                                            @if ($d->tanggal_kadaluarsa >= date('Y-m-d H:i:s'))
                                                <a href="#modalEditLowongan" data-toggle="modal" class='btn btn-warning'
                                                    onclick="modalEdit({{ $d->id }})">
                                                    <i class="fas fa-pen"></i>Edit
                                                </a>
                                                <form method="POST" action="{{ route('lowongan.destroy', $d->id) }}"
                                                    onsubmit="return submitDelete(this);" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger" data-toggle="modal"
                                                        data-toggle="modal"><i class="fas fa-trash"></i>Hapus Lowongan
                                                    </button>
                                                </form>
                                            @else
                                                <span class="badge badge-danger">Ditutup</span>
                                            @endif
                                            <a class="btn btn-success" href="{{ route('lowongan.log', $d->id) }}"> <i
                                                    class="fas fa-clock"></i> Log</a>
                                            <button type="button" class="btn btn-info" data-toggle="modal"
                                                data-target="#modalView" onclick="view({{ $d->id }})">
                                                <i class="fas fa-eye"></i>Lihat 
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="tutup" role="tabpanel" aria-labelledby="tutup-tab">
                {{-- Tutup --}}
                <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable4"
                    role="grid" aria-describedby="sample_1_info">
                    <thead>
                        <tr role="row">
                            <th>Nama Lowongan</th>
                            <th>Bidang Kerja</th>
                            <th>Posisi</th>
                            <th>Tempat Kerja</th>
                            <th>Tanggal Pemasangan</th>
                            <th>Tanggal Penutupan</th>
                            <th>Tanggal Penetapan</th>
                            <th style="width: 22%">Jumlah</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_lowongan as $d)
                            @if ($d->tanggal_kadaluarsa <= date('Y-m-d H:i:s') && $d->tanggal_penetapan >= date('Y-m-d H:i:s'))
                                <tr
                                    style="@if ($d->tanggal_kadaluarsa >= date('Y-m-d')) ; @else background-color: rgba(255, 0, 0, 0.5); @endif">
                                    <td>{{ $d->nama }}</td>
                                    <td>{{ $d->bidang_kerja->nama_bidang }}</td>
                                    <td>{{ $d->posisi }}</td>
                                    <td>{{ $d->kota }}</td>
                                    <td>{{ $d->tanggal_pemasangan }}</td>
                                    <td>{{ $d->tanggal_kadaluarsa }}</td>
                                    <td>{{ $d->tanggal_penetapan }}</td>

                                    @php
                                        $terdaftar = 0;
                                        $diterima = 0;
                                        $seleksi = 0;
                                        $ditolak = 0;
                                        $total = 0;
                                    @endphp
                                    @foreach ($d->lamaran as $i)
                                        @php
                                            $total++;
                                        @endphp
                                        @if ($i->status == 'Terdaftar')
                                            @php
                                                $terdaftar++;
                                            @endphp
                                        @elseif($i->status == 'Diterima')
                                            @php
                                                $diterima++;
                                            @endphp
                                        @elseif($i->status == 'Tahap Seleksi')
                                            @php
                                                $seleksi++;
                                            @endphp
                                        @else
                                            @php
                                                $ditolak++;
                                            @endphp
                                        @endif
                                    @endforeach

                                    <td>
                                        <table style="width: 100%">
                                            <tr>
                                                <td colspan="2" style="text-align: center"><b>Pendaftar :
                                                        {{ $total }}</b>
                                                </td>
                                            </tr>
                                            <tr style="text-align: center">
                                                <td style="width: 50%"> Seleksi : {{ $seleksi }}</td>
                                                <td style="width: 50%"> Diterima : {{ $diterima }}</td>
                                            </tr>
                                            <tr style="text-align: center">
                                                <td style="width: 50%"> Ditolak : {{ $ditolak }}</td>
                                                <td style="width: 50%"> Terdaftar : {{ $terdaftar }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <a class="btn btn-primary" href="{{ route('lamaran.show', $d->id) }}">
                                                <i class="fas fa-users"></i>
                                                Daftar Pelamar
                                            </a>

                                            @if ($d->tanggal_kadaluarsa >= date('Y-m-d H:i:s'))
                                                <a href="#modalEditLowongan" data-toggle="modal" class='btn btn-warning'
                                                    onclick="modalEdit({{ $d->id }})">
                                                    <i class="fas fa-pen"></i>Edit
                                                </a>
                                                <form method="POST" action="{{ route('lowongan.destroy', $d->id) }}"
                                                    onsubmit="return submitDelete(this);" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger" data-toggle="modal"
                                                        data-toggle="modal"><i class="fas fa-trash"></i>Hapus Lowongan
                                                    </button>
                                                </form>
                                            @else
                                                <span class="badge badge-danger">Ditutup</span>
                                            @endif
                                            <a class="btn btn-success" href="{{ route('lowongan.log', $d->id) }}"> <i
                                                    class="fas fa-clock"></i> Log</a>
                                            <button type="button" class="btn btn-info" data-toggle="modal"
                                                data-target="#modalView" onclick="view({{ $d->id }})">
                                                <i class="fas fa-eye"></i>Lihat
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="kadaluarsa" role="tabpanel" aria-labelledby="kadaluarsa-tab">
                {{-- Kadaluarsa --}}
                <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable3"
                    role="grid" aria-describedby="sample_1_info">
                    <thead>
                        <tr role="row">
                            <th>Nama Lowongan</th>
                            <th>Bidang Kerja</th>
                            <th>Posisi</th>
                            <th>Tempat Kerja</th>
                            <th>Tanggal Pemasangan</th>
                            <th>Tanggal Penutupan</th>
                            <th>Tanggal Penetapan</th>
                            <th style="width: 22%">Jumlah</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_lowongan as $d)
                            @if ($d->tanggal_penetapan <= date('Y-m-d H:i:s'))
                                <tr
                                    style="@if ($d->tanggal_kadaluarsa >= date('Y-m-d')) ; @else background-color: rgba(255, 0, 0, 0.5); @endif">
                                    <td>{{ $d->nama }}</td>
                                    <td>{{ $d->bidang_kerja->nama_bidang }}</td>
                                    <td>{{ $d->posisi }}</td>
                                    <td>{{ $d->kota }}</td>
                                    <td>{{ $d->tanggal_pemasangan }}</td>
                                    <td>{{ $d->tanggal_kadaluarsa }}</td>
                                    <td>{{ $d->tanggal_penetapan }}</td>

                                    @php
                                        $terdaftar = 0;
                                        $diterima = 0;
                                        $seleksi = 0;
                                        $ditolak = 0;
                                        $total = 0;
                                    @endphp
                                    @foreach ($d->lamaran as $i)
                                        @php
                                            $total++;
                                        @endphp
                                        @if ($i->status == 'Terdaftar')
                                            @php
                                                $terdaftar++;
                                            @endphp
                                        @elseif($i->status == 'Diterima')
                                            @php
                                                $diterima++;
                                            @endphp
                                        @elseif($i->status == 'Tahap Seleksi')
                                            @php
                                                $seleksi++;
                                            @endphp
                                        @else
                                            @php
                                                $ditolak++;
                                            @endphp
                                        @endif
                                    @endforeach

                                    <td>
                                        <table style="width: 100%">
                                            <tr>
                                                <td colspan="2" style="text-align: center"><b>Pendaftar :
                                                        {{ $total }}</b>
                                                </td>
                                            </tr>
                                            <tr style="text-align: center">
                                                <td style="width: 50%"> Seleksi : {{ $seleksi }}</td>
                                                <td style="width: 50%"> Diterima : {{ $diterima }}</td>
                                            </tr>
                                            <tr style="text-align: center">
                                                <td style="width: 50%"> Ditolak : {{ $ditolak }}</td>
                                                <td style="width: 50%"> Terdaftar : {{ $terdaftar }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <a class="btn btn-primary" href="{{ route('lamaran.show', $d->id) }}">
                                                <i class="fas fa-users"></i>
                                                Daftar Pelamar
                                            </a>

                                            @if ($d->tanggal_kadaluarsa >= date('Y-m-d H:i:s'))
                                                <a href="#modalEditLowongan" data-toggle="modal" class='btn btn-warning'
                                                    onclick="modalEdit({{ $d->id }})">
                                                    <i class="fas fa-pen"></i>Edit
                                                </a>
                                                <form method="POST" action="{{ route('lowongan.destroy', $d->id) }}"
                                                    onsubmit="return submitDelete(this);" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger" data-toggle="modal"
                                                        data-toggle="modal"><i class="fas fa-trash"></i>Hapus Lowongan
                                                    </button>
                                                </form>
                                            @else
                                                <span class="badge badge-danger">Ditutup</span>
                                            @endif
                                            <a class="btn btn-success" href="{{ route('lowongan.log', $d->id) }}"> <i
                                                    class="fas fa-clock"></i> Log</a>
                                            <button type="button" class="btn btn-info" data-toggle="modal"
                                                data-target="#modalView" onclick="view({{ $d->id }})">
                                                <i class="fas fa-eye"></i>Lihat
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalEditLowongan" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" id="modalContent">

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalView" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" id="modalContent2">

        </div>
    </div>
@endsection
