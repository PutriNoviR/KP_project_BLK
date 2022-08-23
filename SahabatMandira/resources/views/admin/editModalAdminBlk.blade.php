<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalEditBlk">Edit Admin Blk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form method="post" action="{{ route('blk.update',$blk->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Balai Latihan Kerja') }}</label>

                <div class="col-md-12">
                    <input id="nama" type="nama" class="form-control @error('email') is-invalid @enderror" name="nama"
                        value="{{ $blk->nama }}" required autocomplete="nama" autofocus>

                    @error('nama')
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
                        name="alamat" value="{{ $blk->alamat }}" required autocomplete="alamat" autofocus>

                    @error('alamat')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="website" class="col-md-12 col-form-label">{{ __('Website Portofolio') }}</label>

                <div class="col-md-12">
                    <input id="website" type="text" class="form-control @error('website') is-invalid @enderror"
                        name="website_portfolio" value="{{ $blk->website_portfolio }}" required autocomplete="website"
                        autofocus>

                    @error('website')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="memilikiSistem" class="col-md-12 col-form-label">{{ __('Memiliki Sistem') }}</label>

                <div class="col-md-12">
                    <select class="form-control" aria-label="Default select example" name="is_punyasistem">
                        <option value="1" {{ $blk->is_punyasistem == 1 ? 'selected' : '' }}>YA</option>
                        <option value="0" {{ $blk->is_punyasistem == 0 ? 'selected' : '' }}>Tidak</option>
                    </select>

                    @error('memilikiSistem')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="linkPendaftaran" class="col-md-12 col-form-label">{{ __('Link Pendaftaran') }}</label>

                <div class="col-md-12">
                    <input id="linkPendaftaran" type="text"
                        class="form-control @error('linkPendaftaran') is-invalid @enderror" name="link_pendaftaran"
                        value="{{ $blk->link_pendaftaran }}" required autocomplete="linkPendaftaran" autofocus>

                    @error('linkPendaftaran')
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
