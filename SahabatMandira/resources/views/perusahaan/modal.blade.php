<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalEditPerusahaan">Edit Perusahaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form method="post" action="{{ route(perusahaan.update) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Perusahaan') }}</label>

                <div class="col-md-12">
                    <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                        value="{{  }}" required autocomplete="nama" autofocus>

                    @error('nama')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="bidang" class="col-md-12 col-form-label">{{ __('Bidang') }}</label>

                <div class="col-md-12">
                    <input id="bidang" type="text" class="form-control @error('bidang') is-invalid @enderror"
                        name="bidang" value="{{  }}" required autocomplete="bidang" autofocus>

                    @error('bidang')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="alamat" class="col-md-12 col-form-label">{{ __('Alamat') }}</label>

                <div class="col-md-12">
                    <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror"
                        name="alamat" value="{{  }}" required autocomplete="alamat" autofocus>

                    @error('alamat')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="noTelp" class="col-md-12 col-form-label">{{ __('Nomor Telepon') }}</label>

                <div class="col-md-12">
                    <input id="noTelp" type="text" class="form-control @error('noTelp') is-invalid @enderror"
                        name="no_telp" value="{{  }}" required autocomplete="noTelp" autofocus>

                    @error('noTelp')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="kodePos" class="col-md-12 col-form-label">{{ __('Kode Pos') }}</label>

                <div class="col-md-12">
                    <input id="kodePos" type="text" class="form-control @error('kodePos') is-invalid @enderror"
                        name="kode_pos" value="{{  }}" required autocomplete="kodePos" autofocus>

                    @error('kodePos')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-md-12 col-form-label">{{ __('Email') }}</label>

                <div class="col-md-12">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{  }}" required autocomplete="email" autofocus>

                    @error('email')
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
