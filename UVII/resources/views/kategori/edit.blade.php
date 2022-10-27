<form action="{{url('menu/kategori/'.$data->id)}}" method="POST">
@csrf
@method("PUT")
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>    
    
        <h5 class="modal-title" id="mediumModalLabel"><strong>Edit Kategori</strong></h5>   
    </div>
                
    <div class="modal-body">
        <div class="form-group">
            <label for="nama" class="form-control-label">Nama</label>
            <input type="text" name="nama" placeholder="Enter category name" class="form-control" value="{{ $data->nama }}" required>
            <input type="hidden" name="id" value="{{$data->id}}">
        </div>
        <div class="form-group">
            <label for="nama" class="form-control-label">Kode</label>
            <input type="text" name="kode" placeholder="Enter code name" class="form-control" value="{{ $data->kode }}" required>
        </div>
        <div class="form-group">
            <label for="nama" class="form-control-label">Kode Poin</label>
            <input type="number" name="kode_poin" placeholder="Using comma (.)" class="form-control" value="{{ $data->kode_poin }}" step="any" required>
        </div>
        <div class="form-group">
            <label for="nama" class="form-control-label">Klaster</label>
            <select name="klaster" class="form-control">
                @foreach($dataKlaster as $d)
                <option value="{{$d->id}}" {{ $data->getNama->id == $d->id ? 'selected':'' }}>{{$d->nama}}</option>
                @endforeach
            </select>
        </div>
    </div>
                
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    </div>
</form>