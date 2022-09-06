@extends('layouts.adminlte')

@section('title')
Lowongan
@endsection

@section('style')
<style>
    .ck-editor__editable_inline {
        min-height: 200px;
    }

</style>
@endsection

@section('page-bar')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">Dashboard</h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Lowongan</li>
    </ol>
</div><!-- /.col -->
@endsection

@section('javascript')
<script>
    ClassicEditor
        .create(document.querySelector('#deskripsi_pekerjaan'))
        .then(editor => {
            editor.ui.view.editable.element.style.height = '200px';
        })
        .catch(error => {
            console.error(error);
        });
    ClassicEditor
        .create(document.querySelector('#kualifikasi_minimal'))
        .catch(error => {
            console.error(error);
        });
    // $('.editor').each(function () {
    //     CKEDITOR.replace($(this).prop('id'));
    // });

    $('#btnSimpanDokumen').click(function () {
        const nama = $('#namadokumen').val();
        $('#dokumen_perusahaan').append(`<div class="col-4">
            <p>- ${nama}</p>
            <input type="hidden" name="dokumen[]" value="${nama}">
        </div>`);
        $('#tambahDokumenModal').modal('hide');
    });

</script>
@endsection

@section('contents')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card-register">
            <div class="card-header">
                <h4>Lowongan</h4>
            </div>
            @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
            @endif
            @if(count($errors) > 0)
            @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                <li>{{$error}}</li>
            </div>
            @endforeach
            @endif

            <div class="card-body">
                <form method="POST" action="{{ route('lowongan.store') }}">
                    @csrf

                    {{-- <div class="form-group p-3 border rounded">
                        <label for="nama" class="col-md-12 col-form-label">{{ __('Nama') }}</label>

                    <div class="col-md-12">
                        <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror"
                            name="nama" required autocomplete="nama" autofocus>

                        @error('nama')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
            </div> --}}

            {{-- <div class="form-group p-3 border rounded">
                        <label for="posisi" class="col-md-12 col-form-label">{{ __('Posisi') }}</label>

            <div class="col-md-12">
                <input id="posisi" type="text" class="form-control @error('posisi') is-invalid @enderror" name="posisi"
                    required autocomplete="posisi" autofocus>

                @error('posisi')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div> --}}

        {{-- <div class="form-group p-3 border rounded">
                        <label for="lokasi" class="col-md-12 col-form-label">{{ __('Lokasi Pekerjaan') }}</label>

        <div class="col-md-12">
            <input id="lokasi" type="text" class="form-control @error('lokasi') is-invalid @enderror"
                name="lokasi_kerja" required autocomplete="lokasi" autofocus>

            @error('lokasi')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div> --}}

    {{-- <div class="form-group p-3 border rounded">
                        <label for="jamKerja" class="col-md-12 col-form-label">{{ __('Jam Kerja') }}</label>

    <div class="col-md-12">
        <input id="jamKerja" type="text" class="form-control @error('jamKerja') is-invalid @enderror" name="jam_kerja"
            required autocomplete="jamKerja" autofocus>

        @error('jamKerja')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div> --}}

{{-- <div class="form-group p-3 border rounded">
                        <label for="gaji" class="col-md-12 col-form-label">{{ __('Gaji') }}</label>

<div class="col-md-12">
    <input id="gaji" type="number" class="form-control @error('gaji') is-invalid @enderror" name="gaji" required
        autocomplete="gaji" autofocus>

    @error('gaji')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
</div> --}}

{{-- <div class="form-group p-3 border rounded">
                        <label for="pengalamanKerja"
                            class="col-md-12 col-form-label">{{ __('Pengalaman Kerja') }}</label>

<div class="col-md-12">
    <input id="pengalamanKerja" type="text" class="form-control @error('pengalamanKerja') is-invalid @enderror"
        name="pengalaman_kerja" required autocomplete="pengalamanKerja" autofocus>

    @error('pengalamanKerja')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
</div> --}}
<div class="form-group p-3 border rounded">
    <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Lowongan') }}</label>
    <div class="col-md-12">
        <input id="nama" type="text" class="form-control" name="nama">
    </div>
</div>
<div class="form-group p-3 border rounded">
    <label for="posisi" class="col-md-12 col-form-label">{{ __('Posisi') }}</label>
    <div class="col-md-12">
        <input id="posisi" type="text" class="form-control" name="posisi">
    </div>
</div>
<div class="form-group p-3 border rounded row">
    <div class="col px-0">
        <label for="tanggal_pemasangan" class="col-md-12 col-form-label">{{ __('Tanggal Pemasangan') }}</label>
        <div class="col-md-12">
            <input id="tanggal_pemasangan" type="date" class="form-control" name="tanggal_pemasangan">
        </div>
    </div>
    <div class="col px-0">
        <label for="tanggal_kadaluarsa" class="col-md-12 col-form-label">{{ __('Tanggal Kadaluarsa') }}</label>
        <div class="col-md-12">
            <input id="tanggal_kadaluarsa" type="date" class="form-control" name="tanggal_kadaluarsa">
        </div>
    </div>
</div>
<div class="form-group p-3 border rounded">
    <label for="deskripsi_pekerjaan" class="col-md-12 col-form-label">{{ __('Deskripsi Pekerjaan') }}</label>

    <div class="col-md-12">
        <textarea name="deskripsi_kerja" id="deskripsi_pekerjaan" class="form-control editor" rows="40"></textarea>

        @error('deskripsiPekerjaan')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group p-3 border rounded">
    <label for="kualifikasi_minimal" class="col-md-12 col-form-label">{{ __('Kualifikasi Minimal') }}</label>

    <div class="col-md-12">
        <textarea name="kualifikasi_minimal" class="form-control editor" id="kualifikasi_minimal" cols="30"
            rows="10"></textarea>

        @error('kualifikasi_minimal')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>


{{-- <div class="form-group p-3 border rounded">
                        <label for="profilPerusahaan"
                            class="col-md-12 col-form-label">{{ __('Profil Perusahaan') }}</label>

<div class="col-md-12">
    <textarea name="profile_perusahaan" class="form-control" rows="3" required></textarea>

    @error('profilPerusahaan')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
</div> --}}
<div class="form-group p-3 border rounded">
    <label class="form-label">Dokumen Persyaratan</label>
    <div id="dokumen_perusahaan" class="row flex-column" style="height: 150px">
    </div>
</div>
<div id="tambah_dokumen" class="p-3 border rounded">
    <button type="button" id="btntambah" class="btn btn-primary btn-block" data-toggle="modal"
        data-target="#tambahDokumenModal">Tambah Dokumen
        Persyaratan</button>
</div>
<input type="hidden" name="perusahaans_id" value="{{ Auth::user()->perusahaans_id_admin }}">
<div class="form-group mb-0 rata_tengah">
    <div class="col-md-12 offset-manual">
        <button type="submit" class="btn btn-primary">
            {{ __('SIMPAN') }}
        </button>
        <br>
    </div>
</div>
</form>
</div>
</div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="tambahDokumenModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Dokumen Persyaratan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="" class="form-label">Nama Dokumen</label>
                    <input type="text" class="form-control" id="namadokumen">
                    <p class="text-muted text-sm">Jenis dokumen yang mendukung : pdf,png,jpg</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="btnSimpanDokumen">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection
