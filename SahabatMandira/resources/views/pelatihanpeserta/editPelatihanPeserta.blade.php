<div class="modal fade" id="modalEditPelatihanPeserta" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Pelatihan Peserta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form method="POST" action="">
                        @csrf

                        <div class="form-group">
                            <label for="nilaiTpa" class="col-md-12 col-form-label">{{ __('Input Nilai TPA') }}</label>

                            <div class="col-md-12">
                                <input id="nilaiTpa" type="text"
                                    class="form-control @error('inputNilaiTpa') is-invalid @enderror" name="nilaiTpa"
                                    value="" required autocomplete="nilaiTpa" autofocus>

                                @error('tesButaWarna')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tesButaWarna"
                                class="col-md-12 col-form-label">{{ __('Hasil Tes Buta Warna') }}</label>

                            <div class="col-md-12">
                                <input id="tesButaWarna" type="text"
                                    class="form-control @error('tesButaWarna') is-invalid @enderror" name="tesButaWarna"
                                    value="" required autocomplete="tesButaWarna" autofocus>

                                @error('tesButaWarna')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="catatanRekomendasi"
                                class="col-md-12 col-form-label">{{ __('Catatan Rekomendasi') }}</label>

                            <div class="col-md-12">
                                <input id="catatanRekomendasi" type="text"
                                    class="form-control @error('catatanRekomendasi') is-invalid @enderror"
                                    name="catatanRekomendasi" value="" required autocomplete="catatanRekomendasi"
                                    autofocus>

                                @error('catatanRekomendasi')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="rekomendasiStatus"
                                class="col-md-12 col-form-label">{{ __('Rekomendasi Status') }}</label>
                            {{--lolos/tidak lolos --}}

                            <div class="col-md-12">
                                <select class="form-control" aria-label="Default select example"
                                    name="rekomendasiStatus">
                                    <option value="1">Lolos</option>
                                    <option value="0">Tidak Lolos</option>
                                </select>

                                @error('rekomendasiStatus')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">SIMPAN
                                PERMANEN</button>
                            <button type="submit" class="btn btn-primary">SIMPAN SEMENTARA</button>
                            <button type="submit" class="btn btn-primary">BATAL</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
