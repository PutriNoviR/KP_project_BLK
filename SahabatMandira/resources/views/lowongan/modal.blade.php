<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalEditLowongan">Edit Lowongan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form method="post" action="{{ route(lowongan.update) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="posisi" class="col-md-12 col-form-label">{{ __('Posisi') }}</label>

                <div class="col-md-12">
                    <input id="posisi" type="text" class="form-control @error('posisi') is-invalid @enderror"
                        name="posisi" value="{{  }}" required autocomplete="posisi" autofocus>

                    @error('posisi')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="lokasi" class="col-md-12 col-form-label">{{ __('Lokasi Pekerjaan') }}</label>

                <div class="col-md-12">
                    <input id="lokasi" type="text" class="form-control @error('lokasi') is-invalid @enderror"
                        name="lokasi_kerja" value="{{  }}" required autocomplete="lokasi" autofocus>

                    @error('lokasi')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="jamKerja" class="col-md-12 col-form-label">{{ __('Jam Kerja') }}</label>

                <div class="col-md-12">
                    <input id="jamKerja" type="text" class="form-control @error('jamKerja') is-invalid @enderror"
                        name="jam_kerja" value="{{  }}" required autocomplete="jamKerja" autofocus>

                    @error('jamKerja')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="gaji" class="col-md-12 col-form-label">{{ __('Gaji') }}</label>

                <div class="col-md-12">
                    <input id="gaji" type="text" class="form-control @error('gaji') is-invalid @enderror" name="gaji"
                        value="{{  }}" required autocomplete="gaji" autofocus>

                    @error('gaji')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="pengalamanKerja" class="col-md-12 col-form-label">{{ __('Pengalaman Kerja') }}</label>

                <div class="col-md-12">
                    <input id="pengalamanKerja" type="text"
                        class="form-control @error('pengalamanKerja') is-invalid @enderror" name="pengalaman_kerja"
                        value="{{  }}" required autocomplete="pengalamanKerja" autofocus>

                    @error('pengalamanKerja')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="pendidikanTerakhir" class="col-md-12 col-form-label">{{ __('Pendidikan Terakhir') }}</label>

                <div class="col-md-12">
                    <input id="pendidikanTerakhir" type="text"
                        class="form-control @error('pendidikanTerakhir') is-invalid @enderror"
                        name="pendidikan__terakhir" value="{{  }}" required autocomplete="pendidikanTerakhir" autofocus>

                    @error('pendidikanTerakhir')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="deskripsiPekerjaan" class="col-md-12 col-form-label">{{ __('Deskripsi Pekerjaan') }}</label>

                <div class="col-md-12">
                    <input id="deskripsiPekerjaan" type="text"
                        class="form-control @error('deskripsiPekerjaan') is-invalid @enderror" name="deskripsi_kerja"
                        value="{{  }}" required autocomplete="deskripsiPekerjaan" autofocus>

                    @error('deskripsiPekerjaan')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="profilPerusahaan" class="col-md-12 col-form-label">{{ __('Profil Perusahaan') }}</label>

                <div class="col-md-12">
                    <input id="profilPerusahaan" type="text"
                        class="form-control @error('profilPerusahaan') is-invalid @enderror" name="profile_perusahaan"
                        value="{{  }}" required autocomplete="profilPerusahaan" autofocus>

                    @error('profilPerusahaan')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
