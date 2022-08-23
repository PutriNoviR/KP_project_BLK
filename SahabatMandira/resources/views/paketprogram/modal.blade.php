<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalEditBlk">Edit Paket Program</h5>
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

                {{-- <div class="col-md-12">
                                <input id="nama" type="nama" class="form-control @error('email') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus>

                @error('nama')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div> --}}

            <div class="col-md-12">

                <select class="form-control" aria-label="Default select example" name="name">
                    <option value="1">BLK satu</option>
                    <option value="0">BLK dua</option>
                </select>

                @error('website')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
    </div>

    <div class="form-group">
        <label for="kejuruan" class="col-md-12 col-form-label">{{ __('Kejuruan') }}</label>

        {{-- <div class="col-md-12">
        <input id="kejuruan" type="text" class="form-control @error('alamat') is-invalid @enderror" name="kejuruan" value="{{ old('kejuruan') }}" required autocomplete="kejuruan" autofocus>

        @error('kejuruan')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div> --}}

    <div class="col-md-12">

        <select class="form-control" aria-label="Default select example" name="kejuruan">
            <option value="1">kejuruan satu</option>
            <option value="0">kejuruan dua</option>
        </select>

        @error('website')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group">
    <label for="subKejuruan" class="col-md-12 col-form-label">{{ __('Sub Kejuruan') }}</label>

    <div class="col-md-12">

        <select class="form-control" aria-label="Default select example" name="subKejuruan">
            <option value="1">Sub kejuruan satu</option>
            <option value="0">Sub kejuruan dua</option>
        </select>

        @error('website')
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