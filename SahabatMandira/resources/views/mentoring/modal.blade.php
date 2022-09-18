<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalEditMentoring">Edit Kejuruan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form method="post" enctype="multipart/form-data" action="{{ route('mandiraMentoring.update',$mentoring->id_mentoring) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Program') }}</label>

                <div class="col-md-12">
                    <input id="nama" type="text" class="form-control " name="nama_program" value="{{ $mentoring->nama_program }}" required autocomplete="nama">

                </div>
            </div>
            <div class="form-group">
                <label for="nama" class="col-md-12 col-form-label">{{ __('Deskripsi Program') }}</label>

                <div class="col-md-12">
                    <input id="nama" type="text" class="form-control " name="deskripsi_program" value="{{ $mentoring->deskripsi_program }}" required autocomplete="nama">

                </div>
            </div>
            <div class="form-group">
                <label for="gambar" class="col-md-12 col-form-label">{{ __('Gambar Kegiatan') }}</label>
                <input type="file" name='gambar' class="defaults" value="{{ $mentoring->gambar }}">
            </div>
            <div class="form-group">
                <label for="tgl_dibuka" class="col-md-12 col-form-label">{{ __('Tanggal Buka Pendaftaran') }}</label>
                <input type="datetime-local" class="col-md-12 col-form-label" name="tgl_dibuka" value="{{ $mentoring->tgl_dibuka }}">

                <div class="col-md-12">

                    @error('website')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="tgl_ditutup" class="col-md-12 col-form-label">{{ __('Tanggal Tutup Pendaftaran') }}</label>
                <input type="datetime-local" class="col-md-12 col-form-label"  name="tgl_ditutup">

                <div class="col-md-12">

                    @error('website')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="nama" class="col-md-12 col-form-label">{{ __('Link Pendaftaran') }}</label>

                <div class="col-md-12">
                    <input id="nama" type="text" class="form-control " name="link_pendaftaran" value="{{ $mentoring->link_pendaftaran}}" required autocomplete="nama">

                </div>
            </div>

            <div class="form-group">
                <label for="nama" class="col-md-12 col-form-label">{{ __('Keahlian') }}</label>

                <div class="col-md-12">
                    <select class="form-control" aria-label="Default select example" name="keahlians_idkeahlians" id="namaKeahlian" readonly>
                        @foreach($daftarKeahlian as $k)
                        <option id="namaKeahlian" value="{{$k->idkeahlians}}">{{$k->nama}}</option>
                        @endforeach
                    </select>
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