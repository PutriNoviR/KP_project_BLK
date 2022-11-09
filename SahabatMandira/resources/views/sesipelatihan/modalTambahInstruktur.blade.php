<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Email Instruktur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

    </div>
    <div class="modal-body">
        <div class="card-body">
            <form method="POST" action="{{ route('pelatihanMentors.store') }}">
                @csrf
                <div class="form-group">
                    <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Instruktur') }}</label>
                    <div class="col-md-12">
                        <select class="form-control" aria-label="Default select example" name="mentors_email"
                            id="nama_instruktur">
                            @foreach($instrukturs as $us)
                            <option value="{{$us->email}}">{{$us->username}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="sesi_pelatihans_id" class="col-md-12 col-form-label"
                        value="{{$idsesipelatihan}}">
                </div>

                <div class="modal-footer justify-content-between px-0">
                    <div>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal"
                            id="btnRiwayatInstruktur" data-target="#modalRiwayatInstuktur"
                            onclick="modalShowRiwayatInstruktur('{{ $instrukturs[0]->email }}')">Riwayat
                            Instuktur</button>
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type=" submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
