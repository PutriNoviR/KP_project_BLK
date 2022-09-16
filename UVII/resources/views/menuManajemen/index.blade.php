@extends('layouts.index',['menu' => $menu_role])

@section('title')
    Menu Manajemen
@endsection
@section('javascript')

<script>
    //$('#myTable').DataTable();

  function getEditForm(id){
    $.ajax({
      type:'POST',
      url:'{{ route("menu.edit")}}',
      data:{'_token':'<?php echo csrf_token() ?>',
            'id':id
          },
      success: function(data){
        // alert(data.msg);
        $('#modalContent').html(data.msg)
      }
    });
  }

  $('#role_user').on('change', function() {
    $('input[type=checkbox]').each(function(){
      $(this).parent().removeClass('checked');
    
    });

    var idrole = $(this).find(":selected").val();
   
    $.ajax({
      type:'POST',
      url:'{{ route("menu.getDataMenu")}}',
      data:{'_token':'<?php echo csrf_token() ?>',
            'id':idrole
          },
      success: function(data){
        for(var i = 0; i < data.msg.length; i++){
        
          $('#menu_'+data.msg[i]).parent().addClass('checked');
          $('#menu_'+data.msg[i]).prop('checked', true);
        
        }

      }
    });
   
  });
 
</script>

@endsection


@section('page-bar')
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{route('home')}}">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('manajemen.index')}}">Menu Manajemen</a>
            <i class="fa fa-angle-right"></i>
        </li>
    </ul>
@endsection
@section('contents')

@if($message = Session::get('status'))
  <div class="alert alert-success">
    <li>{{$message}}</li>
  </div>
@endif
@if($message = Session::get('error'))
  <div class="alert alert-danger">
    <li>{{$message}}</li>
  </div>
@endif


<h4 class="text-center">Menu Manajemen</h4>
<a href="#modalMenu" data-toggle='modal' class='btn btn-info'> Tambah Menu </a><br><br>

<a data-target='#settingModal' data-toggle='modal' class='btn btn-xs btn-success'><i class="fa fa-gear"></i> Setting Menu</a><br><br>


<div class="portlet">
  <div class="portlet-body">
    <table class="table table-striped table-bordered table-hover dataTable no-footer display responsive" id="sample_1" role="grid" aria-describedby="sample_1_info" style="width:100%">    
        <thead>
          <tr role="row">
            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
                aria-label="Rendering engine: activate to sort column ascending">
                      No
            </th>
            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
              aria-label="Browser: activate to sort column ascending">
                      Nama
            </th>
            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
              aria-label="Browser: activate to sort column ascending">
                      Deskripsi
            </th>
            <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
                aria-label="Rendering engine: activate to sort column ascending">
                      Status
            </th>
            
            <th aria-controls="sample_1" tabindex="0" rowspan="1" colspan="1">
                      URL
            </th>
            <th aria-controls="sample_1" tabindex="0" rowspan="1" colspan="1">
                      Aksi
            </th>
            
          </tr>
        </thead>
        <tbody>
            @php 
                $no = 1;
            @endphp
            @foreach($menu as $key=>$data)
            <tr role="row" class="{{ ($key % 2 === 0) ? 'active' : 'success' }}">
                <td class="">
                    {{ $no }}
                </td>
                <td>
                    {{$data->nama }}
                </td>
                <td>
                    {{$data->deskripsi }}
                </td>
                <td>
                    {{$data->status }}
                </td>
                <td>
                    {{$data->url }}
                </td>
                <td>
                <a href="#modalEdit" data-toggle='modal' class='btn btn-warning btn-xs' onclick="getEditForm({{$data->id}})">
                  Edit
              </a>
              <div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content" id='modalContent'></div>
                </div>
              </div> 

              

              {{-- Button Delete 2--}}
              <a class="btn btn-default btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal_{{$data->id}}">
                Delete
              </a>              
              <form method='POST' action="{{route('manajemen.destroy',$data->id) }}">
                  @csrf
                  @method('DELETE')
                  <div id="deleteModal_{{$data->id}}" class="modal fade" tabindex="-1" role="basic">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-body" style="text-align: center;">
                                  <div style="width: 60px; height: 60px; margin: auto;">
                                      <i style="font-size: 46px; color: #8a6d3b; margin-top: 10px;" class="glyphicon glyphicon-warning-sign"></i>
                                  </div>
                                  <p>
                                      Apakah Anda yakin ingin menghapus menu no <b>{{$no}}</b>?
                                  </p>
                                  <input type="hidden" name="id" value="{{ $data->id }}">
                              </div>
                              <div style="border-top: none; text-align: center;" class="modal-footer">
                                  <button type="submit" class="btn btn-danger">Hapus</button>
                                  <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
                                  
                              </div>
                          </div>
                      </div>
                  </div>
              </form>
                </td> 
            </tr>
            @php
                $no++;
            @endphp
            @endforeach
            


        </tbody>
    </table>
 </div>
</div>

{{-- Setting Menu --}}
<div class="modal fade" tabindex="-1" role="dialog" id="settingModal" aria-labelledby="mediumModalLabel" style="display: none; padding-right: 17px;">
        <div id="modalContent" class="modal-dialog" role="document">
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
                            <select id="role_user" class="form-control" name="role_user" required>
                              <option value=''>--Pilih Role--</option>
                               
                                @foreach($role as $r) 
                                    <option value='{{ $r->id }}'>{{ $r->nama_role }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="role" class=" form-control-label">Menu</label>
                            <div class="checkbox-menus">
                                @foreach($menu as $m)
                                  @if($m->status == 'Aktif')
                                    <label>
                                      <input type="checkbox" id='menu_{{$m->id}}' class='menu' class="form-control @error('pendidikan_terakhir') is-invalid @enderror" name="menu[]" value="{{ $m->id }}" autofocus>
                                      {{ $m->nama }}
                                    </label>
                                  @endif
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
        </div>
    </div>
{{--Modal Tambah--}}
<div class="modal fade" id="modalMenu" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Menu Manajemen</h4>  
        </div>

        <form method="POST" action="{{url('manajemen')}}">
          @csrf
            <div class="modal-body">
         
              <div class="form-group row">
              
                  <label for="menu_manajemen" class="col-md-2">Nama:</label>
                  <div class="col-md-8">
                    <input type="text" class='form-control' name='nama' placeholder="nama menu">
                  </div>
                
              </div>
              <div class='form-group row'>
                <!-- <div class="row col-md-12"> -->
                    <label for="menu_manajemen" class="col-md-2">Deskripsi :</label>
                    <div class="col-md-8">
                      <textarea class='form-control' name='deskripsi' rows='3'></textarea>
                    </div>
                <!-- </div> -->
              </div>
                  
              <div class='form-group row'>
                
                  <!-- <div class="row col-md-12">     -->
                      <label for="menu_manajemen" class="col-md-2">Status :</label>
                      <div class="col-md-8">
                        <div class="radio-list">
                          <label>
                            <input type="radio" class='form-control' name='status' value="Aktif">
                            Aktif
                          </label>
                          <label>
                            <input type="radio" class='form-control' name='status' value="Tidak Aktif" checked>
                            Tidak Aktif
                          </label>
                        </div>
                      </div>
                  <!-- </div> -->
              
              </div>
              <div class='form-group row'>
                <!-- <div class="row col-md-12"> -->
                    <label for="menu_manajemen" class="col-md-2">URL :</label>
                    <div class="col-md-8">
                      <textarea class='form-control' name='url' rows='2'></textarea>
                    </div>
                <!-- </div> -->
              </div>
            </div>

            <div class="modal-footer" style="border-top: none; text-align: center;">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            </div>
             
        </form>
        
      </div>
    </div>
  </div>

  {{--Modal Edit--}}
 <div class="modal fade" id="modalMenu" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" id="modalContent">
        
      </div>
    </div>
  </div>
  
@endsection