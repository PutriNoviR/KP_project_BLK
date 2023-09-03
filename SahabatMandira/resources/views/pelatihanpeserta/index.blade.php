@extends('layouts.adminlte')

@section('title')
Pelatihan Peserta
@endsection
@section('javascript')
<script>
    $(function() {
        var table = $("#myTable").DataTable({
            "responsive": true,
            "autoWidth": false,
            columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0,
                },
                {
                    target: 2,
                    visible: false,
                    searchable: false,
                }

            ],
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            order: [
                [1, 'asc']
            ],
            buttons: [
                @if($p == 1)
                {
                    text: 'Update Lulus Seleksi Masal',
                    action: function() {
                        var data = table.rows({
                            selected: true
                        }).data(); //ambil data yang dicentang
                        var emails = [];
                        var sesi_id = '{{$id_sesi}}';
                        //ambil data yang di centang masukkan ke array
                        for (let i = 0; i < data.length; i++) {
                            emails.push(data[i][2]);
                        }

                        console.log(emails);
                        //alert("Mohon Maaf, Fitur ini masih dalam tahap pengembangan.");

                        $.ajax({
                            type: 'POST',
                            url: '{{ route("pelatihanPeserta.updatemasal") }}',
                            data: {
                                '_token': '<?php echo csrf_token() ?>',
                                'emails': emails,
                                'sesi_id': sesi_id
                            },
                            success: function(data) {

                                if (data.status == 'oke') {
                                    Swal.fire(
                                        'Update Hasil Seleksi Secara Masal Berhasil Dilakukan',
                                        'Refresh halaman untuk melihat hasil update seleksi',
                                        'success'
                                    )
                                } else {
                                    Swal.fire(
                                        'Update Hasil Seleksi Secara Masal Gagal',
                                        'Periode Update Seleksi Telah Berakhir !',
                                        'error'
                                    )
                                }
                            },
                            error: function(xhr) {
                                console.log(xhr);
                            }
                        });

                    }
                }
                @endif
            ],
            dom: 'Bflrtip'
        });

        $(".selectAll").on("click", function(e) {
            if ($(this).is(":checked")) {
                table.rows().select();
            } else {
                table.rows().deselect();
            }
        });
    });


    function modalEdit(email, id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("pelatihanPesertas.getEditForm") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'email_peserta': email,
                'sesi_pelatihans_id': id
            },
            success: function(data) {
                $("#modalContent").html(data.msg);
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    }

    function modalKompetensi(email, id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("pelatihanPesertas.getKompetensiForm") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'email_peserta': email,
                'sesi_pelatihans_id': id
            },
            success: function(data) {
                $("#modalContent2").html(data.msg);
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    }

    function alertShow($id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("pelatihanPeserta.getDetail") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': $id,
            },
            success: function(data) {
                swal({
                    title: "Rekomendasi",
                    text: data.data,
                })
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    }
</script>
@endsection


@section('page-bar')

@endsection

@section('contents')
<div class="container">
    <div class="info-box bg-info text-center">
        <h2 class="mx-auto">{{ ($periode->paketprogram->subkejuruan->nama) }} dari {{ ($periode->paketprogram->blk->nama) }}</h2>
    </div>
    <div class="d-flex justify-content-between mb-2">
        <h4 class="mx-auto">Daftar Peserta Dari {{ date('M y', strtotime($periode->tanggal_pendaftaran)) }} -
            {{ date('M y', strtotime($periode->tanggal_tutup)) }}
        </h4>
    </div>

    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @elseif (\Session::has('failed'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! \Session::get('failed') !!}</li>
        </ul>
    </div>
    @endif
    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable" role="grid" aria-describedby="sample_1_info">
        <thead>
            <tr role="row">
                <th><input type="checkbox" class="selectAll" id="selectAll"> <label for="selectAll">Select All</label></th>
                <th>No</th>
                <th>Email</th>
                <th>Nama Peserta</th>
                <th>Profil Peserta</th>
                <th>Status</th>
                <th>Minat</th>
                <th>Daftar Ulang</th>
                <th>Keputusan</th>
                <th>Nilai TPA</th>
                <th>Nilai Rata-Rata Tugas</th>
                <th>Nilai Akhir</th>
                @if($p == 1)
                <th>Aksi</th>
                @endif
                <th>Kompetensi</th>
                @if(Auth::user()->role->nama_role == 'superadmin' || Auth::user()->role->nama_role == 'adminblk')
                <th>Daftar Ulangkan</th>
                @endif
            </tr>
        </thead>
        <tbody id="myTable">
            @if(count($data) > 0)
            @foreach($data as $d)
            <tr>
                <td></td>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->email }}</td>
                <td>{{ $d->nama_depan }} {{ $d->nama_belakang }}</td>
                <td class="text-center">
                    <a data-toggle="modal" data-target="#modalInfoPeserta{{$d->username}}" class="btn btn-info">
                        <i class="fas fa-info-circle"></i>
                    </a>
                </td>
                <td>{{ $d->status_fase }}</td>
                @if( $d->is_sesuai_minat == 1 )
                <td> Sesuai Minat </td>
                @elseif( $d->is_sesuai_minat == 0 )
                <td> Belum Mengikuti Tes </td>
                @elseif( $d->is_sesuai_minat == -1)
                <td> Tidak Sesuai Minat </td>
                @endif
                <td>{{ $d->is_daftar_ulang == 1 ? 'Ya' : 'Tidak'  }}</td>
                <td>
                    {{ $d->rekom_keputusan  }}
                </td>
                <td>
                    <!-- <button class='btn btn-info' onclick="alertShow({{$d->sesi_pelatihans_id}},{{$d->email_peserta}})">
                        <i class="fas fa-eye"></i>
                    </button> -->
                    {{ $d->rekom_nilai_TPA }}
                </td>
                <td>
                    {{ round($d->nilai_rata_rata,2) }}
                </td>
                <td>
                    {{ $d->nilai_akhir}}<br>
                    <a class='btn btn-primary text-white' data-toggle="modal" data-target="#modalEditNilaiAkhir{{$loop->iteration}}" class='btn btn-primary text-white'>
                        Update Nilai Akhir
                    </a>

                </td>
                @if($p == 1)
                <td>
                    <button data-toggle="modal" data-target="#modalEditPelatihanPeserta" class='btn btn-warning' onclick="modalEdit('{{$d->email_peserta}}','{{$d->sesi_pelatihans_id}}')">
                        Update Hasil Seleksi
                    </button>
                </td>
                @endif
                <td>
                    <button data-toggle="modal" @if(strtotime('now') < strtotime($periode->tanggal_selesai_pelatihan) || strtotime('now') >= strtotime($periode->tanggal_selesai_pelatihan ." + 3 days")) disabled @endif data-target="#modalEditRekomendasi" class='btn btn-warning' onclick="modalKompetensi('{{$d->email_peserta}}','{{$d->sesi_pelatihans_id}}')" {{ ($d->hasil_kompetensi  == 'KOMPETEN' || $d->hasil_kompetensi  == ' BELUM KOMPETEN') ? 'disabled' : ''}}>
                        Update Kompetensi
                    </button>
                </td>
                @if(Auth::user()->role->nama_role == 'superadmin' || Auth::user()->role->nama_role == 'adminblk')
                <td>
                    <form method="POST" action="{{ route('sesiPelatihan.daftarulang') }}" class="d-inline">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="sesi_pelatihans_id" class="col-md-12 col-form-label" value="{{$d->sesi_pelatihans_id}}">
                            <input type="hidden" name="email" class="col-md-12 col-form-label" value="{{$d->email_peserta}}">
                            <button data-toggle="modal" data-target="" class='btn btn-success' {{ $d->is_daftar_ulang  == '1' ? 'disabled' : ''}}>
                                Daftar Ulangkan
                            </button>
                        </div>
                    </form>
                </td>
                @endif
            </tr>
            <div class="modal fade" id="modalInfoPeserta{{$d->username}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mx-auto text-bold" id="exampleModalLabel">Data {{ $d->nama_depan}} {{ $d->nama_belakang}}</h5>
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            
                        </div>
                        <div class="modal-body">
                            <center>
                                <div class="mb-3">
                                    <a href="{{ asset('storage/'.$d->ktp) }}" class="btn btn-success" download="KTP_{{Auth::user()->email."_".$d->ktp}}"><i class="fas fa-id-card"></i> &nbsp;Cetak KTP</a>
                                    <a href="{{ asset('storage/'.$d->ksk) }}" class="btn btn-primary" download="KSK_{{Auth::user()->email."_".$d->ksk}}"><i class="fas fa-id-card"></i> &nbsp;Cetak KSK</a>
                                    <a href="{{ asset('storage/'.$d->ijazah) }}" class="btn btn-warning text-white" download="IJAZAH_{{Auth::user()->email."_".$d->ijazah}}"><i class="fas fa-user-graduate"></i> &nbsp;Cetak Ijazah</a>
                                </div>
                                <div class="">
                                    <img class="image-responsive-width" style="height: 400px; width: 300px;" src="{{ asset('storage/'.$d->pas_foto) }}" alt="">
                                </div>
                                <hr>
                                <div>
                                    <label for="">Nomor Identitas</label><br>
                                    <p>{{$d->nomor_identitas}}</p>
                                    <label for="">Nomor HP</label><br>
                                    <p>{{$d->nomer_hp}}</p>
                                    <label for="">Domisili</label><br>
                                    <p>{{$d->kota}}</p>
                                    <label for="">Alamat</label><br>
                                    <p>{{$d->alamat}}</p>
                                    <label for="">Pendidikan Terakhir</label><br>
                                    <p>{{$d->pendidikan_terakhir}}</p>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MODAL EDIT NILAI AKHIR PESERTA --}}
            <div class="modal fade" id="modalEditNilaiAkhir{{$loop->iteration}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Nilai Akhir Peserta</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{route('pelatihanPeserta.updateNilaiAkhir')}}">
                                @csrf
                                <div>
                                    <label for="fileTugas" class="col-md-12 col-form-label">{{ __('Nilai Akhir') }}</label>
                                    <input type="number" name="nilaiAkhir" class="col-md-12 col-form-label" />
                                </div>
                                <input type="hidden" value="{{$d->sesi_pelatihans_id}}" name="id">
                                <input type="hidden" value="{{$d->email_peserta}}" name="email_peserta">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">BATAL</button>
                                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
            @endif
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="modalEditPelatihanPeserta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" name="sesi_pelatihans_id" value="{{$id_sesi}}">
    <div class="modal-dialog" id="modalContent">

    </div>
</div>

<div class="modal fade" id="modalEditRekomendasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" name="sesi_pelatihans_id" value="{{$id_sesi}}">
    <div class="modal-dialog" id="modalContent2">

    </div>
</div>

@endsection