<form class="register-form" method="POST" action="{{route('admin.update')}}">
    @csrf
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>    

        <h5 class="modal-title" id="mediumModalLabel"><strong>Edit Admin</strong></h5>   
    </div>

    <div class="modal-body">

        <div class="row">
            <div class="form-group col-md-4">
                <label for="nama_depan" class=" form-control-label">Nama Depan</label>
                <input type="text" name="nama_depan" placeholder="Enter your firstname" class="form-control" value="{{ $data->nama_depan }}" required>
            </div>

            <div class="form-group col-md-4">
                <label for="nama_belakang" class=" form-control-label">Nama Belakang</label>
                <input type="text" name="nama_belakang" placeholder="Enter your lastname" class="form-control" value="{{$data->nama_belakang}}" required>
            </div>
        </div>

        <div class="form-group">
            <label>No.Handphone</label>
            <input type='text' name="no_hp" class="form-control" value="{{$data->nomer_hp}}" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type='email' name="email" class="form-control" value="{{$data->email}}" required>
            <input type='hidden' name="old_email" class="form-control" value="{{$data->email}}">
        </div>

        <div class="form-group">
            <label>Username</label>
            <input type='text' name="username" class="form-control" value="{{$data->username}}" required>
        </div>
        
        <div class="form-group">
            <label>Kota</label>
            <input type='text' name="kota" class="form-control" value="{{$data->kota}}" required>
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <input type='text' name="alamat" class="form-control" value="{{$data->alamat}}" required>
        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" id="register-submit-btn" class="btn btn-success pull-right">
        Simpan <i class="m-icon-swapright m-icon-white"></i>
        </button>
    </div>
</form>
                