@extends('layouts.adminlte')

@section('title')
PELATIHAN
@endsection

@section('page-bar')

@endsection

@section('javascript')
<script>
    let role = "<?= Auth::user()->role->nama_role ?>"
    $(function () {
        let parameter = {};
        if(role == 'superadmin' || role == 'adminblk'){
            parameter ={
                "responsive": true,
                "autoWidth": false,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print',
                    {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                        }
                    },
                    'colvis'
                ]
            }
            // alert('odar')
            console.log(parameter)
        }
        else
        {
            parameter ={
                "responsive": true,
                "autoWidth": false,
                dom: 'frtip'
            }
        }
        $("#myTable").DataTable(parameter);
    });


    function cetak_sertifikat(sesiPelatihanId, email_user) {
        var canvas = document.getElementById('canvas');
        var ctx = canvas.getContext('2d');
        var downloadBtn = document.getElementById('download-file');

        var prov = "PEMERINTAH PROVINSI JAWA TIMUR";
        var disnaker = "DINAS TENAGA KERJA DAN TRANSMIGRASI";

        $.ajax({
            type: 'POST',
            url: '{{ route("cetak-serti") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id_sesi': sesiPelatihanId,
                'email_user': email_user
            },
            success: function (data) {
                //console.log(data);
                var profil_data = data['profil'];
                var sesi_data = data['sesi_data'][0];
                var data_upt = data['upt_data'][0];
                //console.log(sesi_data);
                //=============================
                var lokasi = sesi_data['nama'].substr(8);
                //console.log(lokasi);
                var upt_blk = 'UPT BALAI LATIHAN KERJA ' + lokasi;
                //var no_peserta = '167.04.014.01.2022';

                var noSurat = sesi_data['nomorSurat'];
                var tgl_surat = sesi_data['tanggalSurat'];

                var pernyataan_atas = 'Kepala Unit Pelaksana Teknis Balai Latihan Kerja ' + titleCase(
                    lokasi) + ' Berdasarkan Surat Keputusan Penyelenggaraan Pelatihan';
                var eng_pa = "Head of The Technical Unit of " + titleCase(lokasi) +
                    " Vocational Training Center Based on The Decree of Training Organization";

                var pernyataan_atas2 =
                    noSurat+' Tanggal '+tgl_lokal(tgl_surat)+' menyatakan, bahwa :';
                var eng_pa2 = noSurat+" dated "+tgl_eng(tgl_surat)+" dclares, that :";

                var profil = 'Nama';
                var profil2 = 'Tempat dan Tanggal Lahir';
                var profil3 = 'Alamat';

                //console.log(profil_data);

                var nama_peserta = profil_data['nama_depan'] + ' ' + profil_data['nama_belakang'];
                var dob = profil_data['tempat_lahir'] + ", " + tgl_lokal(profil_data['tanggal_lahir']);
                var addr = titleCase(profil_data['alamat']);

                var sep = ':';

                var pernyataan_bawah = 'Pelatihan Berbasis Kompetensi (PBK) ';
                var pb_eng = "Competency Based Training Vocation";

                var pernyataan_bawah2 = 'Program ' + sesi_data['nama_program'];

                var hasil_kompetensi = sesi_data['hasil_kompetensi'];
                var jam_pelajaran = sesi_data['jamPelajaran'];
                var pernyataan_bawah3 = 'dari tanggal ' + tgl_lokal(sesi_data['tanggal_mulai_pelatihan']) +
                    ' sampai dengan ' + tgl_lokal(sesi_data['tanggal_selesai_pelatihan']) + ' ('+jam_pelajaran+'JP)';
                var pb3_eng = "from " + tgl_eng(sesi_data['tanggal_mulai_pelatihan']) + " up to " + tgl_eng(
                    sesi_data['tanggal_selesai_pelatihan']) + " ("+jam_pelajaran+" JP)";

                if (hasil_kompetensi == "KOMPETEN") {
                    pernyataan_bawah3 += ' dan dinyatakan ' + hasil_kompetensi.toUpperCase();
                    pb3_eng += " and Declared Competent";
                }

                var tgl_sertif = sesi_data['tanggalSertif'];
                var tgl = titleCase(lokasi) + ', '+tgl_lokal(tgl_sertif);
                var jabatan = 'Kepala UPT Balai Latihan Kerja ' + titleCase(lokasi);
                var jabatan_eng = "Head of " + titleCase(lokasi) + " Vocational Training Center";
                var nama_pembina = data_upt['nama'];
                var sub_jabatan = titleCase(data_upt['jabatan_struktural']);
                var nip = data_upt['nip'];

                let img2 = new Image();
                img2.crossOrigin = "anonymous";
                var pas_foto = profil_data['pas_foto'];
                var fotoprofil = 'storage/'+pas_foto;
                console.log(fotoprofil);
                img2.src = fotoprofil;
                
                var qr_img = new Image();
                qr_img.crossOrigin = "anonymous";
                qr_img.src = data['qr'];

                var image = new Image();
                image.crossOrigin = "anonymous";
                image.src =
                    "{{ asset('storage/Sertifikat/cert.png') }}"; /*template kedua => "{{ asset('storage/Sertifikat/temp.jpg') }}" */

                image.onload = function () {
                    ctx.drawImage(image, 0, 0, canvas.width, canvas.height);
                    ctx.drawImage(img2, 1800, 1950, 300, 400);
                    ctx.drawImage(qr_img, 550, 1950, 350, 350);

                    addImage(ctx, '#000', 'bold 70px TimesNewRoman', 'center', prov, 1805, 275);
                    addImage(ctx, '#000', 'bold 70px TimesNewRoman', 'center', disnaker, 1805, 375);
                    addImage(ctx, '#000', 'bold 85px TimesNewRoman', 'center', upt_blk, 1805, 475);

                    addImage(ctx, '#000', 'bold 100px TimesNewRoman', 'center', 'SERTIFIKAT', 1805,
                        635);
                    addImage(ctx, '#000', 'bold 100px TimesNewRoman', 'center', '____________', 1805,
                        645);
                    addImage(ctx, '#000', 'italic 50px TimesNewRoman', 'center', 'Certificate', 1805,
                        715);

                    // addImage('#000','bold 50px TimesNewRoman','left',no_peserta, 1805, 773);

                    addImage(ctx, '#000', 'bold 50px TimesNewRoman', 'center', pernyataan_atas, 1805,
                        830);
                    addImage(ctx, '#000', 'italic 50px TimesNewRoman', 'center', eng_pa, 1805, 880);

                    addImage(ctx, '#000', 'bold 50px TimesNewRoman', 'center', pernyataan_atas2, 1805,
                        970);
                    addImage(ctx, '#000', 'italic 50px TimesNewRoman', 'center', eng_pa2, 1805, 1020);

                    //
                    addImage(ctx, '#000', '70px TimesNewRoman', 'left', profil, 525, 1115);
                    addImage(ctx, '#000', 'italic 50px TimesNewRoman', 'left', 'Name', 525, 1165);

                    addImage(ctx, '#000', '70px TimesNewRoman', 'left', profil2, 525, 1255);
                    addImage(ctx, '#000', 'italic 50px TimesNewRoman', 'left',
                        "Place and date of birth", 525, 1305);

                    addImage(ctx, '#000', '70px TimesNewRoman', 'left', profil3, 525, 1395);
                    addImage(ctx, '#000', 'italic 50px TimesNewRoman', 'left', "Address", 525, 1445);

                    addImage(ctx, '#000', '70px TimesNewRoman', 'left', sep, 1425, 1115);
                    addImage(ctx, '#000', '70px TimesNewRoman', 'left', sep, 1425, 1255);
                    addImage(ctx, '#000', '70px TimesNewRoman', 'left', sep, 1425, 1395);

                    addImage(ctx, '#000', '70px monotype corsiva', 'left', nama_peserta, 1525, 1115);
                    addImage(ctx, '#000', '70px monotype corsiva', 'left', dob, 1525, 1255);
                    addImage(ctx, '#000', '70px monotype corsiva', 'left', addr, 1525, 1395);

                    //

                    addImage(ctx, '#000', 'bold 65px TimesNewRoman', 'center', "TELAH MENGIKUTI", 1805,
                        1510);
                    addImage(ctx, '#000', 'italic 50px TimesNewRoman', 'center', "Have Followed", 1805,
                        1560);

                    addImage(ctx, '#000', 'bold 53px TimesNewRoman', 'center', pernyataan_bawah, 1805,
                        1620);
                    addImage(ctx, '#000', 'italic 53px TimesNewRoman', 'center', pb_eng, 1805, 1670);

                    addImage(ctx, '#000', 'bold 53px TimesNewRoman', 'center', '"' + pernyataan_bawah2
                        .toUpperCase() + '"', 1805, 1730);

                    addImage(ctx, '#000', 'bold 53px TimesNewRoman', 'center', pernyataan_bawah3, 1805,
                        1800);
                    addImage(ctx, '#000', 'italic 53px TimesNewRoman', 'center', pb3_eng, 1805, 1850);

                    addImage(ctx, '#000', '45px TimesNewRoman', 'center', tgl, 2705, 1920);
                    addImage(ctx, '#000', 'bold 45px TimesNewRoman', 'center', jabatan, 2705, 1980);
                    addImage(ctx, '#000', 'italic 43px TimesNewRoman', 'center', jabatan_eng, 2705,
                        2030);
                    addImage(ctx, '#000', 'bold 45px TimesNewRoman', 'center', nama_pembina, 2705,
                        2220);
                    addImage(ctx, '#000', 'bold 53px TimesNewRoman', 'center',
                        '_____________________________', 2705, 2225);
                    addImage(ctx, '#000', '43px TimesNewRoman', 'center', sub_jabatan, 2705, 2285);
                    addImage(ctx, '#000', 'bold 45px TimesNewRoman', 'center', 'NIP. ' + nip, 2705,
                        2335);

                    //console.log('fin-download');
                    downloadBtn.href = canvas.toDataURL('image/jpg');
                    downloadBtn.download = 'Certificate - ' + Date.now();
                    downloadBtn.click();
                };

            },
            error: function (xhr) {
                console.log(xhr);
            }
        });
    }

    function tgl_lokal(tanggal) {
        var myDate = new Date(tanggal);

        var month = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ][myDate.getMonth()];

        var str = myDate.getDate() + ' ' + month + ' ' + myDate.getFullYear();

        return str;
    }

    function tgl_eng(tanggal) {
        var myDate = new Date(tanggal);

        var month = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ][myDate.getMonth()];

        var str = month + ' ' + myDate.getDate() + '=' + myDate.getFullYear();

        return str;
    }

    function addImage(ctx, color, font, align, data, x, y) {
        // ctx.clearRect(0, 0, canvas.width, canvas.height)
        // ctx.drawImage(image, 0, 0, canvas.width, canvas.height);
        ctx.font = font;
        ctx.fillStyle = color;
        ctx.textAlign = align;
        ctx.fillText(data, x, y);
    }

    function titleCase(str) {
        var splitStr = str.toLowerCase().split(' ');
        for (var i = 0; i < splitStr.length; i++) {
            // You do not need to check if i is larger than splitStr length, as your for does that for you
            // Assign it back to the array
            splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
        }
        // Directly return the joined string
        return splitStr.join(' ');
    }

    function modalEdit(sesiPelatihanId) {
        $.ajax({
            type: 'POST',
            url: '{{ route("sesiPelatihan.getEditForm") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': sesiPelatihanId,
            },
            success: function (data) {
                $("#modalContent").html(data.msg);
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });
    }

    function notification(form) {
        swal({
                title: "Success!",
                text: "Sudah Daftar Ulang",
                icon: "success",
                buttons: "Oke",
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        return false;
    }

    function submitFormDelete(form) {
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

    function alertShow(id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("sesiPelatihan.getDetail") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': id,
            },
            success: function (data) {
                swal({
                    title: "Aktivitas",
                    text: data.data,
                })
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });
    }

    function alertShowPeserta(id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("sesiPelatihan.getDetailPeserta") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': id,
            },
            success: function (data) {
                swal({
                    title: "Data Peserta",
                    text: data.data,
                })
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });
    }

    function modalTambahInstuktur(idsesipelatihan) {
        $.ajax({
            type: 'POST',
            url: '{{ route("sesiPelatihan.getTambahInstruktur") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': idsesipelatihan
            },
            success: function (data) {
                $(`#modalContentTambahInstruktur`).html(data.msg);
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });
    }

    function modalShowRiwayatInstruktur(email) {
        $.ajax({
            type: 'POST',
            url: '{{ route("sesiPelatihan.getRiwayatInstruktur") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'mentors_email': email,
            },
            success: function (data) {
                $(`#modalContentRiwayatInstruktur`).html(data.msg);
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });
    }
    $('body').on('change', '#nama_instruktur', function () {
        var email = $('#nama_instruktur').val();
        $('#btnRiwayatInstruktur').attr('onclick', `modalShowRiwayatInstruktur('${email}')`);
    });

</script>
@endsection


@section('contents')
{{--SISI PESERTA --}}

@if(Auth::user()->role->nama_role == 'peserta')

<div class="container">
    <div class="d-flex justify-content-between mb-2">
        <h2>Riwayat Pelatihan</h2>
    </div>
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @endif
    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable" role="grid"
        aria-describedby="sample_1_info">
        <thead>
            <tr role="row">
                <th>No</th>
                <th>Nama Balai Latihan Kerja</th>
                <th>Kejuruan</th>
                <th>Sub Kejuruan</th>
                <th>Periode</th>
                <th>Status</th>
                <th>Daftar</th>
                <th>Sertifikat</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach($dataPeserta as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->paketprogram->blk->nama }}</td>
                <td>{{ $d->paketprogram->kejuruan->nama }}</td>
                <td>{{ $d->paketprogram->subkejuruan->nama }}</td>
                <td>{{ date('d-M-y', strtotime($d->tanggal_pendaftaran)) }} -
                    {{ date('d-M-y', strtotime($d->tanggal_tutup)) }}
                </td>
                <td>{{ $d->status_fase}}</td> {{-- lulus/ cadangan / tidak lulus--}}
                <td>
                    <form method="POST" action="{{ route('sesiPelatihan.daftarulang') }}" class="d-inline">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="sesi_pelatihans_id" class="col-md-12 col-form-label"
                                value="{{$d->sesi_pelatihans_id}}">
                            @if($d->status_fase == 'DITERIMA' || $d->status_fase == 'PESERTA CADANGAN')
                            <button data-toggle="modal" data-target="" class='btn btn-success'
                                {{ $d->is_daftar_ulang  == '1' ? 'disabled' : ''}}>
                                Daftar Ulang
                            </button> {{-- kalau lolos atau cadangan di enable kalo ga lolos disable--}}
                            @else
                            <button data-toggle="modal" data-target="" class='btn btn-danger' disabled
                                {{ $d->is_daftar_ulang  == '1' ? 'disabled' : ''}}>
                                Daftar Ulang
                            </button> {{-- kalau lolos di enable kalo ga lolos disable--}}
                            @endif
                        </div>
                    </form>
                </td>
                <td>
                    <canvas id="canvas" height="2522px" width="3615px" hidden></canvas>
                    <button class='btn btn-warning' {{ $d->hasil_kompetensi == NULL ? 'disabled' : ''}}
                        onclick="cetak_sertifikat('{{ $d->sesi_pelatihans_id }}','{{ Auth::user()->email }}');">
                        Download Sertifikat
                    </button> {{-- kalau lolos di enable kalo ga lolos disable--}}
                    <a href hidden id="download-file"></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

{{--SISI VERIFIKATOR --}}

@if(Auth::user()->role->nama_role == 'verifikator')
<div class="container">
    <div class="d-flex justify-content-between mb-2">
        <h2>Daftar Sesi Pelatihan</h2>
    </div>
    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable" role="grid"
        aria-describedby="sample_1_info">
        <thead>
            <tr role="row">
                <th>No</th>
                <th>BLK</th>
                <th>Kejuruan</th>
                <th>Sub Kejuruan</th>
                <th>Periode Pendaftaran</th>
                <th>Lokasi</th>
                <th>Kuota</th>
                <th>Tanggal Seleksi</th>
                <th>Aktivitas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach($dataInstruktur as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->paketprogram->blk->nama }}</td>
                <td>{{ $d->paketprogram->kejuruan->nama }}</td>
                <td>{{ $d->paketprogram->subkejuruan->nama }}</td>
                <td>{{ date('d-M-y', strtotime($d->tanggal_pendaftaran)) }} -
                    {{ date('d-M-y', strtotime($d->tanggal_tutup)) }}
                </td>
                <td>{{ $d->lokasi }}</td>
                <td>{{ $d->kuota }}</td>
                <td>{{ $d->tanggal_seleksi }}</td>
                <td><button class='btn btn-info' onclick="alertShow({{$d->id}})">
                        <i class="fas fa-eye"></i>
                    </button></td>
                <td>
                    <!-- <a data-toggle="modal" data-target="#modalDetailPeserta{{$d->id}}" class='btn btn-info' value>
                        <i class="fas fa-eye"></i>
                    </a> -->
                    <a href="{{ url('pelatihanPesertas/'.$d->id) }}" class="button btn btn-primary">
                        <i class="fas fa-eye"></i> {{--PINDAHIN KE UI  --}}
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif


{{--SISI SUPER ADMIN--}}

@if(Auth::user()->role->nama_role == 'superadmin' || Auth::user()->role->nama_role == 'adminblk')
<div class="container">
    <div class="d-flex justify-content-between mb-2">
        <h2>Pengelolaan Sesi Pelatihan</h2>
    </div>
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @endif
    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable" role="grid"
        aria-describedby="sample_1_info">
        <thead>
            <tr role="row">
                <th>No</th>
                <th>BLK</th>
                <th>Kejuruan</th>
                <th>Sub Kejuruan</th>
                <th>Periode Pendaftaran</th>
                <th>Instruktur/Verifikator</th>
                <th>Lokasi</th>
                <th>Kuota</th>
                <th>Tanggal Seleksi</th>
                <th>Aktivitas</th>
                <th>Aksi</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach($data as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->paketprogram->blk->nama }}</td>
                <td>{{ $d->paketprogram->kejuruan->nama }}</td>
                <td>{{ $d->paketprogram->subkejuruan->nama }}</td>
                <td>{{ date('d-M-y', strtotime($d->tanggal_pendaftaran)) }} -
                    {{ date('d-M-y', strtotime($d->tanggal_tutup)) }}
                </td>
                <td>
                    @foreach($d->pelatihanmentor as $pm)
                        @if($loop->last)
                            {{$pm->nama_depan ." ".$pm->nama_belakang}}
                        @else
                            {{$pm->nama_depan ." ".$pm->nama_belakang.", "}}
                            <br>
                        @endif

                    @endforeach
                </td>
                <td>{{ $d->lokasi }}</td>
                <td>{{ $d->kuota }}</td>
                <td>{{ $d->tanggal_seleksi }}</td>
                <td><button class='btn btn-info' onclick="alertShow({{$d->id}})">
                        <i class="fas fa-eye"></i>
                    </button></td>
                <td>
                    @php
                    date_default_timezone_set("Asia/Bangkok");
                    @endphp
                    @if (strtotime($d->tanggal_tutup) <= strtotime("now")) <button class='btn btn-secondary disabled'>
                        Tambah Instruktur
                        </button>
                        <button class='btn btn-secondary disabled'>
                            <i class="fas fa-pen"></i>
                        </button>
                        <button type="button" class="btn btn-secondary disabled"><i class="fas fa-trash"></i>
                        </button>
                        @else
                        <a data-toggle="modal" data-target="#modalTambahInstruktur" class='btn btn-warning'
                            onclick="modalTambahInstuktur({{$d->id}})">
                            Tambah Instruktur
                        </a>
                        <a data-toggle="modal" data-target="#modalEditSesiPelatihan" class='btn btn-warning'
                            onclick="modalEdit({{$d->id}})">
                            <i class="fas fa-pen"></i>
                        </a>
                        <form method="POST" action="{{ route('sesiPelatihan.destroy',$d->id) }}"
                            onsubmit="return submitFormDelete(this);" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger" data-toggle="modal" href=""
                                data-toggle="modal"><i class="fas fa-trash"></i>
                            </button>
                        </form>
                        @endif

                </td>
                <td>
                    <a href="{{ route('pelaporan.show',$d->id) }}" class="button btn btn-primary">
                        Daftar Peserta</i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{-- BUAT PANGGIL MODAL YANG ADA DI MODAL.BLADE --}}
<!-- Modal -->
<div class="modal fade" id="modalEditSesiPelatihan" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContent">

    </div>
</div>

{{-- Modal tambah Instruktur --}}
<div class="modal fade" id="modalTambahInstruktur" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContentTambahInstruktur">

    </div>
</div>
<div class="modal fade" id="modalRiwayatInstuktur" tabindex="-1" aria-labelledby="modalRiwayatInstukturLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContentRiwayatInstruktur">
        <div class="modal-content">

        </div>
    </div>
</div>
@endif
@endsection
