@extends('layouts.index')

@section('title')
    Menu Role
@endsection

@section('javascript')
<script>
    function getEditForm(id)
    {
        $.ajax({
        type:'POST',
        url:'{{route("role.edit")}}',
        data:{'_token':'<?php echo csrf_token() ?>',
            'roleId':id
        },
        success: function(data){
            $('#modalContent').html(data.msg)
        }
        });
    }
</script>
@endsection

@section('page-bar')
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="http://127.0.0.1:8000/">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>

        <li>
            <a href="http://127.0.0.1:8000/menu/role">Role</a>
            <i class="fa fa-angle-right"></i>
        </li> 
    </ul>
@endsection

@section('contents')

@if($message = Session::get('success'))
  
  <div class="alert alert-success">
    <li>{{$message}}</li>
  </div>
@endif

@if(count($errors) > 0)
  @foreach($errors->all() as $error)
  <div class="alert alert-danger">
    <li>{{$error}}</li>
  </div>
  @endforeach
@endif


<div class="portlet">
        <div class="portlet-title">
            <div class="caption">
               Hak Akses Pengguna
            </div>
        </div>
        <div class="portlet-body">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="table-group-actions pull-right">
                        <button class="btn btn-xs btn-success" data-target='#tambahModal' data-toggle='modal'><i class="fa fa-plus"></i> Tambah Data</button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>
                        No
                    </th>
                    <th>
                        Nama
                    </th>
                    <th>
                        Detail
                    </th>
                    <th>
                        Aksi
                    </th>
                </tr>
                </thead>
                <tbody>
                    @php 
                        $no = 1;
                    @endphp

                    @foreach($data as $d)
                   
                    <tr>
                        <td>
                            {{$no}}
                        </td>
                        <td>
                            {{$d->nama_role}}
                        </td>
                        <td>
                            <a data-toggle='modal' data-target='#modal_{{$d->id}}' class="btn btn-default btn-xs btn-info"><i class="fa fa-eye"></i> View</a>
                        </td>
                        <td>
                            <a onclick="getEditForm({{ $d->id }})" data-toggle='modal' data-target='#editModal' class="btn btn-default btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>
                           
                            <a class="btn btn-default btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal_{{$d->id}}">
                                <i class="fa fa-trash-o"></i> Hapus
                            </a>
                            
                            <form method='POST' action="{{ url('menu/role/'.$d->id) }}">
                                @csrf
                                @method('DELETE')
                                <div id="deleteModal_{{$d->id}}" class="modal fade" tabindex="-1" role="basic">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body" style="text-align: center;">
                                                <div style="width: 60px; height: 60px; margin: auto;">
                                                    <i style="font-size: 46px; color: #8a6d3b; margin-top: 10px;" class="glyphicon glyphicon-warning-sign"></i>
                                                </div>
                                                <p>
                                                    Apakah Anda yakin ingin menghapus data <b>{{$d->nama_role}}</b>?
                                                </p>
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

                    <div class="modal fade" id="modal_{{$d->id}}" tabindex="-1" role="basic" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><i style="font-size: 20px" class="fa fa-group"></i> {{$d->nama_role}}</h4>
                                    
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Deskripsi</label>
                                        <textarea name="deskripsi" class="form-control" rows="3" disabled>{{$d->deskripsi}}</textarea>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Data User</label>:
                                        @foreach($d->find($d->id)->users as $user)
                                            <span class="btn btn-xs btn-info">{{$user->username}}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div style="border-top: none; text-align: center;" class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- modal tambah role --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="tambahModal" aria-labelledby="mediumModalLabel" style="display: none; padding-right: 17px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>    
                
                    <h5 class="modal-title" id="mediumModalLabel"><strong>Tambah Role</strong></h5>   
                </div>
                
                <form class="register-form" method="POST" action="{{url('/menu/role')}}">
                        @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama" class=" form-control-label">Nama</label>
                            <input type="text" name="nama" placeholder="Enter role name" class="form-control" required>
                        </div>
                   
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
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

    {{-- modal edit role --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="editModal" aria-labelledby="mediumModalLabel" style="display: none; padding-right: 17px;">
        <div class="modal-dialog" role="document">
            <div id='modalContent' class="modal-content">
               
            </div>
        </div>
    </div>

@endsection