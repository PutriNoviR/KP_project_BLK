<form class="register-form" method="POST" action="{{route('admin.update')}}">
    @csrf
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>    

        <h5 class="modal-title" id="mediumModalLabel"><strong>Edit Peserta</strong></h5>   
    </div>

    <div class="modal-body">

        <div class="row">
            <div class="form-group col-md-4">
                <label for="nama_depan" class=" form-control-label">Nama Depan</label>
                <input type="text" name="nama_depan" placeholder="Enter your firstname" class="form-control" value="{{dataAdmin->nama_depan}}" required>
            </div>

            <div class="form-group col-md-4">
                <label for="nama_belakang" class=" form-control-label">Nama Belakang</label>
                <input type="text" name="nama_belakang" placeholder="Enter your lastname" class="form-control" value="{{dataAdmin->nama_belakang}}" required>
            </div>
        </div>

        <div class="form-group">
            <label>No.Handphone</label>
            <input name="no_hp" class="form-control" rows="3" value="{{dataAdmin->nomer_hp}}" required></input>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input name="email" class="form-control" rows="3" required value="{{dataAdmin->email}}" required></input>
        </div>

        <div class="form-group">
            <label>Username</label>
            <input name="username" class="form-control" rows="3" value="{{dataAdmin->username}}" required></input>
        </div>
        
        <div class="form-group">
            <label>Kota</label>
            <input name="kota" class="form-control" rows="3" required value="{{dataAdmin->kota ?? '' }}" required></input>
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <input name="alamat" class="form-control" rows="3" required value="{{dataAdmin->alamat ?? '' }}" required></input>
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" id="register-submit-btn" class="btn btn-success pull-right">
        Simpan <i class="m-icon-swapright m-icon-white"></i>
        </button>
    </div>
</form>
                