<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalEditPelatihanPeserta">EDIT HASIL SELEKSI PESERTA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        @if($check == '1')
        <form method="post" action="{{ route('pelatihanPesertas.update',$data->email_peserta) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama" class="col-md-12 col-form-label">{{ __('Email Peserta') }}</label>
                <div class="col-md-12">
                    <input id="nama" type="nama" class="form-control @error('email') is-invalid @enderror" name="email_peserta" value="{{$data->email_peserta}}" readonly autocomplete="nama" autofocus>
                    <input type="hidden" name="sesi_pelatihans_id" class="col-md-12 col-form-label" value="{{$data->sesi_pelatihans_id}}">
                    @error('nama')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="nama" class="col-md-12 col-form-label">{{ __('Rekomendasi catatan') }}</label>
                <div class="col-md-12">
                    <input id="nama" type="nama" class="form-control @error('email') is-invalid @enderror" name="rekom_catatan" value="{{$data->rekom_catatan}}" required autocomplete="nama" autofocus>
                    @error('nama')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class=" form-group">
                <label for="nama" class="col-md-12 col-form-label">{{ __('Nilai TPA') }}</label>
                <div class="col-md-12">
                    <input id="nama" type="nama" class="form-control @error('email') is-invalid @enderror" name="rekom_nilai_TPA" value="{{$data->rekom_nilai_TPA}}" required autocomplete="nama" autofocus>
                    @error('nama')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="nama" class="col-md-12 col-form-label">{{ __('Rekomendasi Keputusan') }}</label>

                <div class="col-md-12">
                    <select class="form-control" aria-label="Default select example" name="rekom_keputusan" value="{{$data->rekom_keputusan}}">
                        <option value="LULUS">Diterima</option>
                        <option value="TIDAK LULUS">Tidak Diterima</option>
                        <option value="CADANGAN">Cadangan</option>
                        <option value="MENGUNDURKAN DIRI">Mengundurkan Diri</option>
                    </select>

                    @error('nama')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <input type="hidden" id="permanent" name="rekom_is_permanent" class="col-md-12 col-form-label" value="0">
                <div class="modal-footer">
                    <div>
                        <button onclick="" type="submit" id="sementara" name="action" class="btn btn-default" value="1">Simpan Sementara</button>
                        <button onclick="myFunction(); submitFormSimpanPermanen(this);" type="submit" id="permanent" name="action" class="btn btn-primary">Simpan Permanen</button>
                    </div>


                </div>
            </div>
        </form>
        @else
        <form method="post" action="{{ route('pelatihanPesertas.updateKompetensi',$data->email_peserta) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama" class="col-md-12 col-form-label">{{ __('Hasil Kompetensi') }}</label>
                <input type="hidden" name="sesi_pelatihans_id" class="col-md-12 col-form-label" value="{{$data->sesi_pelatihans_id}}">

                <div class="col-md-12">
                    <select class="form-control" aria-label="Default select example" name="hasil_kompetensi" value="{{$data->hasil_kompetensi}}">
                        <option value="Kompeten">Kompeten</option>
                        <option value="Belum Kompeten">Belum Kompeten</option>
                    </select>

                    @error('nama')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="modal-footer">
                    <div>
                        <button type="submit" id="permanent" name="action" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
        @endif
    </div>
</div>


<script>
    function myFunction() {
        document.getElementById("permanent").value = 1
    }

    function submitFormSimpanPermanen(form) {
        var permanent = document.getElementById('permanent');
        if (permanent.onclick) {
            swal({
                    title: "Peringatan!",
                    text: "Apakah anda yakin ingin Menyimpan Permanen data ini?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        }
        return false;
    }
</script>