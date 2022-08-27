<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalEditPelatihanPeserta">EDIT STATUS PESERTA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form method="post" action="">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama" class="col-md-12 col-form-label">{{ __('Status') }}</label>

                <div class="col-md-12">
                    <select class="form-control" aria-label="Default select example" name="subKejuruan">
                        <option value="terdaftar">Terdaftar</option>
                        <option value="dalam seleksi">Dalam seleksi</option>
                        <option value="diterima">Diterima</option>
                        <option value="ditolak">Ditolak</option>
                        <option value="sedang proses pelatihan">Sedang Proses Pelatihan</option>
                        <option value="lulus pelatihan">Lulus Pelatihan</option>
                        <option value="direkomendasi untuk uji kompetensi">Direkomendasikan Untuk Uji Kompetensi
                        </option>
                    </select>

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
                    <input id="nama" type="nama" class="form-control @error('email') is-invalid @enderror" name="nama"
                        value="" required autocomplete="nama" autofocus>

                    @error('nama')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>


            <div class=" form-group">
                <label for="nama" class="col-md-12 col-form-label">{{ __('Rekomendasi Nilai TPA') }}</label>

                <div class="col-md-12">
                    <input id="nama" type="nama" class="form-control @error('email') is-invalid @enderror" name="nama"
                        value="{{ old('nama') }}" required autocomplete="nama" autofocus>

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
                    <select class="form-control" aria-label="Default select example" name="subKejuruan">
                        <option value="Lulus">Lulus</option>
                        <option value="Tidak Lulus">Tidak Lulus</option>
                        <option value="Cadangan">Cadangan</option>
                    </select>

                    @error('nama')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="nama" class="col-md-12 col-form-label">{{ __('Hasil Kompetensi') }}</label>

                <div class="col-md-12">
                    <select class="form-control" aria-label="Default select example" name="subKejuruan">
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
        </form>
    </div>


    <div class="form-group">
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </div>
</div>
