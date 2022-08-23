<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalEditKejuruan">Edit Kejuruan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form method="post" action="{{ route('kejuruans.update',$kejuruan->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Kejuruan') }}</label>

                <div class="col-md-12">
                    <input id="nama" type="nama" class="form-control" name="nama" value="{{ $kejuruan->nama }}" required
                        autocomplete="nama" autofocus>
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
