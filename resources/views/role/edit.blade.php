<form action="{{url('menu/role/'.$data->id)}}" method="POST">
@csrf
@method("PUT")
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>    
    
        <h5 class="modal-title" id="mediumModalLabel"><strong>Edit Role</strong></h5>   
    </div>
                
    <div class="modal-body">
        <div class="form-group">
            <label for="nama" class=" form-control-label">Nama</label>
            <input type="text" name="nama" placeholder="Enter role name" class="form-control" value="{{ $data->nama_role }}" required>
        </div>
    
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3" required>{{$data->deskripsi}}</textarea>
        </div>
    </div>
                
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    </div>
</form>