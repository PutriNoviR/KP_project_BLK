<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Edit Paket Program</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form method="post" action="{{ route('paketProgram.update',$paketProgram->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">

                <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Balai Latihan Kerja') }}</label>
                <div class="col-md-12">
                    <select class="form-control" aria-label="Default select example" name="namaBlk">
                        @foreach($blk as $d)
                        <option value="{{$d->id}}" {{$d->id==$paketProgram->blks_id ? 'selected':''}}>{{$d->nama}}
                        </option>
                        {{-- untuk melakukan pengecekan seperti if apakah id blk yang ada di paket program sama dengan id blk yang ada di foreach ?--}}
                        @endforeach
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

                <div class="col-md-12">
                    <select class="form-control" aria-label="Default select example" name="kejuruan">
                        @foreach($kejuruan as $d)
                        <option value="{{$d->id}}" {{$d->id==$paketProgram->kejuruans_id ? 'selected':''}}>{{$d->nama}}
                        </option>
                        {{-- untuk melakukan pengecekan seperti if apakah id blk yang ada di paket program sama dengan id kejuruan yang ada di foreach ?--}}
                        @endforeach
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
                        @foreach($subKejuruan as $d)
                        <option value="{{$d->id}}" {{$d->id==$paketProgram->sub_kejuruans_id ? 'selected':''}}>
                            {{$d->nama}}</option>
                        {{-- untuk melakukan pengecekan seperti if apakah id blk yang ada di paket program sama dengan id kejuruan yang ada di foreach ?--}}
                        @endforeach
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
                    <button type="submit" class="btn btn-primary">Simpannnnnn</button>
                </div>
            </div>
        </form>
    </div>
</div>
