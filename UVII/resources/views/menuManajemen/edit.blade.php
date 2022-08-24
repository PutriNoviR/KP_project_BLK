<form method="POST" action="{{url('manajemen/'.$manajemenEdit->id)}}">
  @csrf
  @method("PUT")
  <div class="modal-header">
    <h4 class="modal-title">Edit Menu Manajemen</h4>  
  </div>
  
  <div class="modal-body">

    <div class="form-group row">
    
      <label for="menu_manajemen" class="col-md-2">Nama:</label>
      <div class="col-md-8">
        <input type="text" class='form-control' name='nama' placeholder="nama menu" value="{{$manajemenEdit->nama}}">
        <input type="hidden" name="id" value="{{ $manajemenEdit->id }}">
        
      </div>
      
    </div>
    
    <div class='form-group row'>
      <!-- <div class="row col-md-12"> -->
      <label for="menu_manajemen" class="col-md-2">Deskripsi :</label>
      <div class="col-md-8">
        <textarea class='form-control' name='deskripsi' rows='3'>{{$manajemenEdit->deskripsi}}</textarea>
      </div>
      <!-- </div> -->
    </div>
                  
    <div class='form-group row'>
      
        <!-- <div class="row col-md-12">     -->
      <label for="menu_manajemen" class="col-md-2">Status :</label>
      <div class="col-md-8">
        <div class="radio-list">
          <label>
            <input type="radio" name='status' value="Aktif" {{ $manajemenEdit->status == 'Aktif' ? 'checked':'' }}>
            Aktif
          </label>
         
          <label>
            <input type="radio" name='status' value="Tidak Aktif" {{ $manajemenEdit->status == 'Tidak Aktif' ? 'checked':'' }}>
              Tidak Aktif
          </label>
        </div>
      </div>   
    </div>
        <!-- </div> -->
    <div class='form-group row'>
      <!-- <div class="row col-md-12"> -->
      <label for="menu_manajemen" class="col-md-2">URL :</label>
      <div class="col-md-8">
        <textarea class='form-control' name='url' rows='2'>{{$manajemenEdit->url}}</textarea>
      </div>
      <!-- </div> -->
    </div>
  </div>
   
  <div class="modal-footer" style="border-top: none; text-align: center;">
    <button type="submit" class="btn btn-primary">Simpan</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
  </div>
      
</form>
        