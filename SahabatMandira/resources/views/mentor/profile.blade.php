@extends('layouts.adminlte')

@section('title')
Profile
@endsection


@section('javascript')
<script>
    $(function() {
        $('#btnubahdata').click(function() {
            $('#btnubahdata').hide();
            $('#data-mentor').hide();
            $('#btnubahkeahlian').show();
            $('#ubahDataMentor').removeClass('d-none');
            $('#ubahKeahlianMentor').addClass('d-none');
        });

        $('#btnubahkeahlian').click(function() {
            $('#btnubahkeahlian').hide();
            $('#data-mentor').hide();
            $('#btnubahdata').show();
            $('#ubahKeahlianMentor').removeClass('d-none');
            $('#ubahDataMentor').addClass('d-none');
        });

        $('#btnbatal').click(function() {
            $('#btnubahkeahlian').show();
            $('#btnubahdata').show();
            $('#data-mentor').show();
            $('#ubahDataMentor').addClass('d-none');
        })

        $('#btnsimpan').click(function() {
            $('#btnubahdata').show();
            $('#data-mentor').show();
            $('#ubahDataMentor').addClass('d-none');
        })

        $('#btnSimpanKeahlian').click(function() {
            const nama = $('#namaKeahlian').val();
            const id = $('#namaKeahlian option:selected').attr('id-keahlian');
            // alert(id);
            $('#tbody').append(`<tr>
            <td style="width:90%">${nama}</td>
            <input type="hidden" name="keahlian[]" value="${id}">
            <td style="width:10%"><button type="button"  class="btndeleterow btn btn-danger"><i
                                class="fas fa-trash"></i></button></td>
        </tr>`);
            $('#tambahKeahlianMentor').modal('hide');
        });

        $('body').on('click', '.btndeleterow', function() {
            $(this).parent().parent().remove();
        })
    });
</script>
@endsection

@section('contents')
<section class="content">
    <div class="container-fluid">
        <div class="card p-5">
            <div class="d-flex">
                <img src="{{ asset('storage/'.$user->pas_foto) }}" class="rounded-circle d-block" width="100" height="100" alt="">
                <div class="ml-5 d-flex justify-content-between w-100">
                    <div class="">
                        <h3 class="font-weight-normal">{{ $user->nama_depan }} {{ $user->nama_belakang }}</h3>
                        <span class="text-muted d-block">Nomor Telepon : {{ $user->nomer_hp }}</span>
                        <span class="text-muted d-block">Email : {{ $user->email }}</span>
                        @foreach($daftarKeahlian as $k)
                        <span class="text-muted">#{{ $k->nama}} </span>
                        @endforeach
                    </div>
                    <div>
                        <button class="btn btn-outline-primary rounded font-weight-bold" id="btnubahdata">Ubah
                            Data</button>
                        <button class="btn btn-outline-primary rounded font-weight-bold" id="btnubahkeahlian">Ubah
                            Keahlian</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card p-4" id="data-mentor">
            <h3 class="mb-4 font-weight-bold">Data Mentor</h3>
            <div class="row">
                <div class="col-4">
                    <p>
                        <span class="text-muted d-block">Nama Mentor</span>
                        <span>{{ $user->nama_depan }} {{ $user->nama_belakang }}</span>
                    </p>
                    <p>
                        <span class="text-muted d-block">Email Mentor</span>
                        <span>{{ $user->email }}</span>
                    </p>
                </div>
                <div class="col-4">
                    <p>
                        <span class="text-muted d-block">Nomor Telepon</span>
                        <span>{{ $user->nomer_hp }}</span>
                    </p>
                    <p>
                        <span class="text-muted d-block">Alamat</span>
                        <span>{{ $user->alamat }}</span>
                    </p>
                </div>

            </div>
            <hr>
        </div>
        <form class="card p-4 d-none" id="ubahDataMentor" action="{{ route('User.update',$user->email) }}" method="POST">
            @csrf
            @method('PUT')
            <h3 class="mb-4 font-weight-bold">Data Mentor</h3>
            <div class="row">
                <div class="col-4">
                    <p>
                        <span class="text-muted d-block">Nama Depan Mentor</span>
                        <input type="text" class="form-control" name="nama_depan" id="nama-user" value="{{ $user->nama_depan}}">
                    </p>
                    <p>
                        <span class="text-muted d-block">Nama Belakang Mentor</span>
                        <input type="text" class="form-control" name="nama_belakang" id="nama-user" value="{{ $user->nama_belakang}}">
                    </p>
                    <p>
                        <span class="text-muted d-block">Email Mentor</span>
                        <input type="text" class="form-control" disabled id="email-perusahaan" value="{{ $user->email}}">
                    </p>
                </div>
                <div class="col-4">
                    <p>
                        <span class="text-muted d-block">Nomor Telepon</span>
                        <input type="text" class="form-control" id="notelp-perusahaan" value="{{ $user->nomer_hp}}">
                    </p>
                    <p>
                        <span class="text-muted d-block">Alamat</span>
                        <textarea class="form-control" name="alamat_perusahaan" id="alamat-perusahaan" rows="2">{{ $user->alamat}}</textarea>
                    </p>
                </div>
            </div>
            <hr>
            <div class="text-right">
                <button id="btnbatal" class="btn btn-outline-primary mr-2 font-weight-bold">Batal</button>
                <button type="submit" id="btnsimpan" class="btn btn-primary rounded font-weight-bold">Simpan</button>
            </div>
        </form>
        <div class="card p-4 d-none" id="ubahKeahlianMentor">
            <form method="POST" action="{{ route('keahlianUser.store') }}">
                @csrf
                <div class="form-group p-3 border rounded">
                    <label class="form-label">Keahlian</label>
                    <div id="dokumen_perusahaan" class="row flex-column" style="min-height: 150px">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 90%">Nama</th>
                                    <th style="width: 10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="tambah_dokumen" class="p-3 border rounded">
                    <button type="button" id="btntambah" class="btn btn-primary btn-block" data-toggle="modal" data-target="#tambahKeahlianMentor">Tambah Keahlian</button>
                </div>
                <div class="form-group mt-3 rata_tengah">
                    <div class="col-md-12 offset-manual">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('SIMPAN') }}
                        </button>
                        <br>
                    </div>
                </div>
            </form>


            <!-- Modal -->
            <div class="modal fade" id="tambahKeahlianMentor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Keahlian Mentor</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <!-- <label for="" class="form-label">Keahlian</label> -->
                                <select class="form-control" aria-label="Default select example" name="mentors_email" id="namaKeahlian" readonly>
                                    @foreach($keahlian as $k)
                                    <option id="namaKeahlian" value="{{$k->nama}}" id-keahlian="{{$k->idkeahlians}}">{{$k->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-primary" id="btnSimpanKeahlian">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection