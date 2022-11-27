@extends('layouts.adminlte')

@section('title')
Pelatihan Peserta
@endsection
@section('javascript')
<script>
    $(function() {
        $("#myTable").DataTable({
            "responsive": true,
            "autoWidth": false,

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
    <div class="info-box bg-info">
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
                <th>No</th>
                <th>Nama Peserta</th>
                <th>Profil Peserta</th>
                <th>Status</th>
                <th>Minat</th>
                <th>Daftar Ulang</th>
                <th>Keputusan</th>
                <th>Nilai TPA</th>
                <th>Aksi</th>
                <th>Kompetensi</th>
                @if(Auth::user()->role->nama_role == 'superadmin' || Auth::user()->role->nama_role == 'adminblk')
                <th>Daftar Ulangkan</th>
                @endif
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach($data as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->nama_depan }} {{ $d->nama_belakang }}</td>
                <td class="text-center">
                  <a data-toggle="modal" data-target="#modalInfoPeserta{{$d->username}}" class="btn btn-info">
                    <i class="fas fa-info-circle"></i>
                  </a>
                </td>
                <td>{{ $d->status_fase }}</td>
                @if( $d->is_sesuai_minat == 1 )
                <td> Ya </td>
                @elseif( $d->is_sesuai_minat == 0 )
                <td> Belum Mengisi </td>
                @elseif( $d->is_sesuai_minat == -1)
                <td> Tidak </td>
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
                    <button data-toggle="modal" data-target="#modalEditPelatihanPeserta" class='btn btn-warning' onclick="modalEdit('{{$d->email_peserta}}','{{$d->sesi_pelatihans_id}}')" {{ $d->rekom_is_permanent == 1 ? 'disabled' : '' }}>
                        Update Hasil Seleksi
                    </button>
                </td>
                <td>
                    <button data-toggle="modal" data-target="#modalEditRekomendasi" class='btn btn-warning' onclick="modalKompetensi('{{$d->email_peserta}}','{{$d->sesi_pelatihans_id}}')" {{ ($d->hasil_kompetensi  == 'KOMPETEN' || $d->hasil_kompetensi  == ' BELUM KOMPETEN') ? 'disabled' : ''}}>
                        Update Kompetensi
                    </button>
                </td>
                @if(Auth::user()->role->nama_role == 'superadmin' || Auth::user()->role->nama_role == 'adminblk')
                <td>
                    <button data-toggle="modal" data-target="#" class='btn btn-warning' onclick="modalKompetensi('{{$d->email_peserta}}','{{$d->sesi_pelatihans_id}}')" {{ $d->hasil_kompetensi  == 'KOMPETEN' || $d->hasil_kompetensi  == ' BELUM KOMPETEN' ? 'disabled' : ''}}>
                        Daftar Ulang
                    </button>
                </td>
                @endif
            </tr>
            <div class="modal fade" id="modalInfoPeserta{{$d->username}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Data {{ $d->nama_depan}} {{ $d->nama_belakang}}</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div>
                        <img class="image-responsive-width" style="height: 90%; width: 90%;" src="{{ asset('storage/'.$d->pas_foto) }}" alt="">
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
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="modalEditPelatihanPeserta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" name="sesi_pelatihans_id" value="{{$d->sesi_pelatihans_id}}">
    <div class="modal-dialog" id="modalContent">

    </div>
</div>

<div class="modal fade" id="modalEditRekomendasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" name="sesi_pelatihans_id" value="{{$d->sesi_pelatihans_id}}">
    <div class="modal-dialog" id="modalContent2">

    </div>
</div>

@endsection