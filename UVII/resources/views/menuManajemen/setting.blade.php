
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>    
                
                    <h5 class="modal-title" id="mediumModalLabel"><strong>Setting Menu</strong></h5>   
                </div>
                
                <form class="register-form" method="POST" action="{{ route('manajemen.role') }}">
                        @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="role" class=" form-control-label">Role</label>
                            <select class="form-control" name="role_user" required>
                              <option value=''>--Pilih Role--</option>
                               
                                @foreach($role as $r)
                                  <option value='{{ $r->id }}'>{{ $r->nama_role }}</option>
                               
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="role" class=" form-control-label">Menu</label>
                            <div class="checkbox-menus">
                                <!-- @php dd($menu); @endphp -->
                                @foreach($menu as $m)
                                @foreach($menu_role as $arr)
                                <input type="checkbox" name="vehicle3" value="Boat" checked>
                                  <label>
                                    <!-- <input type="checkbox" class='menu' class="form-control @error('pendidikan_terakhir') is-invalid @enderror" name="menu[]" 
                                    value="{{ $m->id }}" checked > -->
                                    <!-- {{ $arr->id == $m->id "checked":""} -->
                                    {{ $m->nama }}
                                  </label>
                                @endforeach
                                @endforeach
                               
                               
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" id="register-submit-btn" class="btn btn-success pull-right">
                        Simpan <i class="m-icon-swapright m-icon-white"></i>
                        </button>
                    </div>

                </form>
                
            </div>
