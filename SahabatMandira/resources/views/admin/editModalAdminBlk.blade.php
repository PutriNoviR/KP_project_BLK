<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalEditBlk">Edit Admin Blk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form method="POST" action="{{ route('super.adminblk.update') }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama" class="col-md-12 col-form-label">{{ __('BLK') }}</label>

                <div class="col-md-12">
                    <select name="blks_id" class="form-control">
                        @foreach ($blks as $blk)
                        <option value="{{ $blk->id }}" {{ $admin->blk->id == $blk->id ? 'selected' : '' }}>
                            {{ $blk->nama }}</option>
                        @endforeach
                    </select>
                    <input id="email" type="hidden" class="form-control" name="email" required autocomplete="email"
                        autofocus value="{{ $admin->email }}">

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">SIMPAN</button>
            </div>
        </form>
    </div>
</div>
