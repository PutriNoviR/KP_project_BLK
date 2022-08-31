<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalEditRekomendasi">EDIT KOMPETENSI PESERTA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        @foreach($data as $d)
        <form method="post" action="{{ route('pelatihanPesertas.updateKompetensi',$d->email_peserta) }}" >
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama" class="col-md-12 col-form-label">{{ __('Hasil Kompetensi') }}</label>

                <div class="col-md-12">
                    <select class="form-control" aria-label="Default select example" name="hasil_kompetensi" value="{{$d->hasil_kompetensi}}">
                        <option value="Kompeten">Kompeten</option>
                        <option value="Belum Kompeten">Belum Kompeten</option>
                    </select>

                    @error('nama')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group">
                <label for="nama" class="col-md-12 col-form-label">{{ __('Status') }}</label>
                <div class="col-md-12">
                    <select class="form-control" aria-label="Default select example" name="status" value="{{$d->status}}">
                        <option value="ditolak">Ditolak</option>
                        <option value="lulus pelatihan">Diterima</option>
                        </option>
                    </select>
                    @error('nama')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <input type="hidden" id="permanent" name="rekom_is_permanent" class="col-md-12 col-form-label" value="0">
                <div class="modal-footer">
                    <div>
                        <button onclick="" type="submit" id="sementara" name="action" class="btn btn-default" value="1">Simpan Sementara</button>
                        <button onclick="myFunction(); submitFormSimpanPermanen(this);" type="submit" id="permanent" name="action" class="btn btn-primary">Simpan Permanen</button>
                    </div>


                </div>
            </div>
        </form>
        @endforeach
    </div>
</div>

<script>
    function myFunction() {
        document.getElementById("permanent").value = 1
    }

    function submitFormSimpanPermanen(form) {
        var permanent = document.getElementById('permanent');
        if(permanent.onclick){
            swal({
                title: "Peringatan!",
                text: "Apakah anda yakin ingin Menyimpan Permanen data ini?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        }
        return false;
    }
</script>