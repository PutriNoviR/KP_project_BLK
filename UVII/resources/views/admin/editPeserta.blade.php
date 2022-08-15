<form action="{{url('menu/peserta/'.$data->email)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method("PUT")
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>    

        <h5 class="modal-title" id="mediumModalLabel"><strong>Edit Peserta</strong></h5>   
    </div>
                
    <div class="modal-body">
        <div class="tab-content">
   
            <div class="tab-pane active" id="tab_1_3">
                <div class="row profile-account">
                    <div class="col-md-5">
                        <ul class="ver-inline-menu tabbable margin-bottom-10">
                            <li class="active">
                                <a data-toggle="tab" onclick="updateTabAt('tab_1')" href="#tab_1-1">
                                    <i class="fa fa-cogs"></i> Data Pribadi 
                                </a>
                                <span class="after">
                                </span>
                            </li>
                            <li class="" >
                                <a data-toggle="tab" onclick="updateTabAt('tab_2')" href="#tab_2-2">
                                    <i class="fa fa-file"></i> Dokumen
                                </a>
                            </li>
                            <li class="">
                                <a data-toggle="tab" onclick="updateTabAt('tab_3')" href="#tab_3-3">
                                    <i class="fa fa-file"></i> Informasi Tambahan
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                    <input type="hidden" id='theTab' name="tab" value="tab_1">

                    <div class="col-md-12">
                        <div class="tab-content">
                            <div id="tab_1-1" class="tab-pane active">
                          
                                <div class="form-group"><label for="email" class=" form-control-label">Email</label><input type="email" name="email" placeholder="Enter your email" class="form-control" value="{{$data->email}}"></div>
                                        
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="nama_depan" class=" form-control-label">Nama Depan</label>
                                        <input type="text" name="nama_depan" placeholder="Enter your firstname" class="form-control" value="{{$data->nama_depan}}" required>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="nama_belakang" class=" form-control-label">Nama Belakang</label>
                                        <input type="text" name="nama_belakang" placeholder="Enter your lastname" class="form-control" value="{{$data->nama_belakang}}" required>
                                    </div>
                                </div>
                            
                                <div class="form-group"><label for="no_hp" class=" form-control-label">Nomor Handphone</label><input type="text" name="no_hp" placeholder="Enter your phone number" class="form-control" value="{{$data->nomer_hp}}" required></div>

                                <div class="form-group"><label for="alamat" class="form-control-label">Alamat</label><input type="text" name="alamat" placeholder="Enter your address" class="form-control" value="{{$data->alamat}}" required></div>
                                
                                <div class="form-group"><label for="kota" class="form-control-label">Kota</label><input type="text" name="kota" placeholder="Enter your city" class="form-control" value="{{$data->kota}}" required></div>
                            
                                <div class="margiv-top-10 pull-right">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                </div>
                          
                            </div>

                            <div id="tab_2-2" class="tab-pane"> 
                         
                                <p>
                                    <span class="label label-danger">NOTE!</span>
                                    Upload semua dokumen dalam bentuk .JPG, .PNG atau .PDF
                                </p>
                                
                                <input type="hidden" name="email" value="{{$data->email}}">

                                <div class="form-group">
                                    <label for="pas_foto" class="form-control-label">Pas Foto</label>
                                    
                                    <span class="btn btn-default btn-file">
                                        <input type="file" name='pas_foto' class="default">
                                    </span> 
                                </div>

                                <div class="form-group">
                                    <label for="ktp" class="form-control-label">KTP</label>
                                    
                                    <span class="btn btn-default btn-file">
                                        <input type="file" name='no_ktp' class="default">
                                    </span> 
                                </div>

                                <div class="form-group">
                                    <label for="ksk" class="form-control-label">KSK</label>
                                    
                                    <span class="btn btn-default btn-file">
                                        <input type="file" name='ksk' class="default">
                                    </span> 
                                </div>

                                <div class="form-group">
                                    <label for="ijazah" class="form-control-label">Ijazah</label>
                                    
                                    <span class="btn btn-default btn-file">
                                        <input type="file" name='ijazah' class="default">
                                    </span> 
                                </div>

                                <div class="margiv-top-10 pull-right">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                </div>
                        
                            </div>

                            <div id="tab_3-3" class="tab-pane">
                             
                              
                                <input type="hidden" name="email" value="{{$data->email}}">
                                <input type="hidden" name="password" placeholder="Enter your password" class="form-control" value="{{$data->password}}" required>
                           
                                <div class="form-group">
                                    <label for="tipe_identitas" class="form-control-label">Kewarganegaraan</label>
                                    <select class="form-control" name="tipe_identitas" required>
                                        <option value="KTP" {{ ($data->jenis_identitas == 'KTP')? 'selected':'' }}>Warga Negara Indonesia</option>
                                        <option value="Pasport" {{ ($data->jenis_identitas == 'Pasport')? 'selected':'' }}>Warga Negara Asing</option>
                                    </select>
                                </div>
        
                                <div class="form-group"><label for="no_identitas" class="form-control-label">Nomor Identitas</label><input type="text" name="no_identitas" placeholder="Enter your identity number" class="form-control" value="{{$data->nomor_identitas}}" required></div>

                                <div class="form-group"><label for="username" class="form-control-label">Username</label><input type="text" name="username" placeholder="Enter your username" class="form-control" value="{{$data->username}}" required></div>

                               <div class="margiv-top-10 pull-right">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form