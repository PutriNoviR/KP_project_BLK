<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Detail Kerja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form method="post" action="{{ route('subkejuruan.update',$sub->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Sub Kejuruan') }}</label>
                <div class="col-md-12">
                    <input id="nama" type="text" class="form-control " name="nama_subkejuruan" required
                        autocomplete="nama">
                </div>
            </div>
            <div class="form-group">
                <label for="nama" class="col-md-12 col-form-label">{{ __('aktivitas') }}</label>
                <div class="col-md-12">
                    <textarea name="aktivitas" class="form-control" required id="aktivitas" cols="40"
                        rows="10"></textarea>
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

