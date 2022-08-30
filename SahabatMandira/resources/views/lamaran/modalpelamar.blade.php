<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalEditPelamar">Kandidat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form method="post" action="{{ route('lamaran.update',$lamaran->lowongans_id) }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="users_email" value="{{ $lamaran->users_email }}">
            <div class="form-group">
                <select class="form-control" name="status">
                    <option value="Terdaftar">Terdaftar</option>
                    <option value="Tahap Seleksi">Seleksi</option>
                    <option value="Tidak Lolos Seleksi">Tolak</option>
                </select>
            </div>
            <div class="form-group">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
