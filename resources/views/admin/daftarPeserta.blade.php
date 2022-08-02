@extends('layouts.index')

@section('title')
    Daftar Peserta
@endsection

@section('javascript')
<script>
    function getEditForm(id)
    {
        $.ajax({
            type:'POST',
            url:'{{route("peserta.edit")}}',
            data:{'_token':'<?php echo csrf_token() ?>',
                'email':id
            },
            success: function(data){
                $('#modalContent').html(data.msg)
            }
        });
    }
    
    function updateTabAt(no){
        $('#theTab').val(no);
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
            <a href="http://127.0.0.1:8000/menu/peserta">Peserta</a>
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
               Daftar Peserta
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>
                        No
                    </th>
                    <th>
                        Nama Lengkap
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Username
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
                            {{$d->nama_depan." ".$d->nama_belakang}}
                        </td>
                        <td>
                            {{$d->email}}
                        </td>
                        <td>
                            {{$d->username}}
                        </td>
                        <td>
                            <a data-toggle='modal' data-target='#modal_{{$d->username}}' class="btn btn-default btn-xs btn-info"><i class="fa fa-eye"></i> View</a>
                        </td>
                        <td>
                            <a onclick="getEditForm('{{ $d->email }}')" data-toggle='modal' data-target='#editModal' class="btn btn-default btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>
                           
                            <a class="btn btn-default btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal_{{$d->username}}">
                                <i class="fa fa-trash-o"></i> Hapus
                            </a>
                            
                            <form method='POST' action="{{ url('menu/peserta/'.$d->email) }}">
                                @csrf
                                @method('DELETE')
                                <div id="deleteModal_{{$d->username}}" class="modal fade" tabindex="-1" role="basic">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body" style="text-align: center;">
                                                <div style="width: 60px; height: 60px; margin: auto;">
                                                    <i style="font-size: 46px; color: #8a6d3b; margin-top: 10px;" class="glyphicon glyphicon-warning-sign"></i>
                                                </div>
                                                <p>
                                                    Apakah Anda yakin ingin menghapus data <b>{{$d->username}}</b>?
                                                </p>
                                                <input type='hidden' name='email' value='{{ $d->email }}'>
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

                    <div class="modal fade" id="modal_{{$d->username}}" tabindex="-1" role="basic" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><i style="font-size: 20px" class="fa fa-user"></i> {{$d->username}}</h4>
                                    <small>{{$d->email}}</small>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Alamat</label>
                                        <input name="alamat" class="form-control" disabled value='{{$d->alamat}}'>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Kota</label>
                                        <input name="kota" class="form-control" disabled value='{{$d->kota}}'>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Nomor Hp</label>
                                        <input name="nomor_hp" class="form-control" disabled value='{{$d->nomer_hp}}'>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">kewarganegaraan</label>
                                        <input name="kewarganegaraan" class="form-control" disabled value='{{$d->tipe_identitas}}'>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Nomor Identitas</label>
                                        <input name="nomor_identitas" class="form-control" disabled value='{{$d->nomor_identitas}}'>
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

    {{-- modal edit role --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="editModal" aria-labelledby="mediumModalLabel" style="display: none; padding-right: 17px;">
        <div class="modal-dialog" role="document">
            <div id='modalContent' class="modal-content">
               
            </div>
        </div>
    </div>


                

@endsection