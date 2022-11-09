{{-- MODAL UNTUK EDIT SESI PELATIHAN--}}
<div class="modal fade" id="modalEditSesiPelatihan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContent">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Sesi Pelatihan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route() }}">
                    @csrf

                    <div class="form-group">
                        <label for="tanggalBukaPendaftaran" class="col-md-12 col-form-label">{{ __('Tanggal Buka Pendaftaran') }}</label>
                        <input type="datetime-local" class="col-md-12 col-form-label" name="tanggal_pendaftaran">

                        <div class="col-md-12">

                            @error('website')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tanggalTutupPendaftaran" class="col-md-12 col-form-label">{{ __('Tanggal Tutup Pendaftaran') }}</label>
                        <input type="datetime-local" class="col-md-12 col-form-label" name="tanggal_tutup">

                        <div class="col-md-12">

                            @error('website')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="lokasi" class="col-md-12 col-form-label">{{ __('Lokasi') }}</label>
                        <input type="text" class="col-md-12 col-form-label" name="lokasi">
                    </div>

                    <div class="form-group">
                        <label for="tanggalMulaiPelatihan" class="col-md-12 col-form-label">{{ __('Tanggal Mulai Pelatihan') }}</label>
                        <input type="datetime-local" class="col-md-12 col-form-label" name="tanggal_mulai_pelatihan">

                        <div class="col-md-12">

                            @error('website')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tanggalSelesaiPelatihan" class="col-md-12 col-form-label">{{ __('Tanggal Selesai Pelatihan') }}</label>
                        <input type="datetime-local" class="col-md-12 col-form-label" name="tanggal_selesai_pelatihan">

                        <div class="col-md-12">

                            @error('website')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="kuota" class="col-md-12 col-form-label">{{ __('Harga') }}</label>
                        <input type="text" class="col-md-12 col-form-label" name="harga">
                    </div>

                    <div class="form-group">
                        <label for="kuota" class="col-md-12 col-form-label">{{ __('Kuota') }}</label>
                        <input type="text" class="col-md-12 col-form-label" name="kuota">
                    </div>

                    <div class="form-group">
                        <label for="tanggalSeleksi" class="col-md-12 col-form-label">{{ __('Tanggal Seleksi') }}</label>
                        <input type="datetime-local" class="col-md-12 col-form-label" name="tanggal_seleksi">

                        <div class="col-md-12">

                            @error('website')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="kuota" class="col-md-12 col-form-label">{{ __('Nomor Surat') }}</label>
                        <input type="text" class="col-md-12 col-form-label" name="nomorSurat" value="">
                    </div>

                    <div class="form-group">
                        <label for="tanggalSurat" class="col-md-12 col-form-label">{{ __('Tanggal Surat') }}</label>
                        <input type="datetime-local" class="col-md-12 col-form-label" name="tanggalSurat">

                        <div class="col-md-12">

                            @error('website')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tanggalSertif" class="col-md-12 col-form-label">{{ __('Tanggal Sertifikat') }}</label>
                        <input type="datetime-local" class="col-md-12 col-form-label" name="tanggalSertif">

                        <div class="col-md-12">

                            @error('website')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="aktivitas" class="col-md-12 col-form-label">{{ __('Aktivitas') }}</label>
                        <textarea class="col-md-12 col-form-label" rows="3" name="aktivitas">{{$paketprogram->subkejuruan->aktivitas}}</textarea>
                        <input type="hidden" name="paket_program_id" class="col-md-12 col-form-label" value="{{$paketprogram->id}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>