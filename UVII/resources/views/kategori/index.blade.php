@extends('layouts.index',['menu' => $menu_role])

@section('title')
    Kategori
@endsection
@section('javascript')
<script>
    function getEditForm(id)
    {
        $.ajax({
        type:'POST',
        url:'{{route("kategori.edit")}}',
        data:{'_token':'<?php echo csrf_token() ?>',
            'id':id
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
            <a href="{{route('home')}}">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>

        <li>
            <a href="{{route('kategori.index')}}">Kategori</a>
            <i class="fa fa-angle-right"></i>
        </li> 
    </ul>
@endsection

@section('contents')
<a data-target='#tambahModal' data-toggle='modal' class='btn btn-xs btn-success'><i class="fa fa-plus"></i> Tambah Kategori</a><br><br>

<div class="portlet">
        <div class="portlet-title">
            <div class="caption">
               Kategori
            </div>
        </div>

        <div class="portlet-body"> 

            <table class="table table-striped table-bordered table-hover dataTable no-footer" id="sample_1" role="grid" aria-describedby="sample_1_info">
                <thead>
                <tr role="row">
                    <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
                        aria-label="Rendering engine: activate to sort column ascending" style="width: 129px;">
                        No
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
                        aria-label="Browser: activate to sort column ascending" style="width: 250px;">
                        Kode
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
                        aria-label="Browser: activate to sort column ascending" style="width: 250px;">
                        Nama
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
                        aria-label="Browser: activate to sort column ascending" style="width: 250px;">
                        Kode Poin
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
                        aria-label="Browser: activate to sort column ascending" style="width: 250px;">
                        Klaster Psikometrik
                    </th>
                    <th aria-controls="sample_1" tabindex="0" rowspan="1" colspan="1" style="width: 120px;">
                        Aksi
                    </th>
                </tr>
                </thead>
                <tbody>
                    @php 
                        $no = 1;
                    @endphp

                    @foreach($data as $key=>$d)
                   
                    <tr role="row" class="{{ ($key % 2 === 0) ? 'active' : 'success' }}">
                        <td>
                            {{$no}}
                        </td>
                        <td>
                            {{$d->nama}}
                        </td>
                        <td>
                            {{$d->kode}}
                        </td>
                        <td>
                            {{$d->kode_poin}}
                        </td>
                        <td>
                            {{$d->getNama->nama}}
                        </td>
                        <td>
                            <a onclick="getEditForm({{ $d->id }})" data-toggle='modal' data-target='#editModal' class="btn btn-default btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>
                           
                            <a class="btn btn-default btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal_{{$d->id}}">
                                <i class="fa fa-trash-o"></i> Hapus
                            </a>
                            
                            <form method='POST' action="{{ url('menu/kategori/'.$d->id) }}">
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
                                                    Apakah Anda yakin ingin menghapus data <b>{{$d->nama}}</b>?
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

                    @endforeach
                </tbody>
            </table>
        </div>
</div>
{{-- modal tambah kategori--}}
    <div class="modal fade" tabindex="-1" role="dialog" id="tambahModal" aria-labelledby="mediumModalLabel" style="display: none; padding-right: 17px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>    
                
                    <h5 class="modal-title" id="mediumModalLabel"><strong>Tambah Kategori</strong></h5>   
                </div>
                
                <form class="register-form" method="POST" action="{{url('/menu/kategori')}}">
                        @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama" class=" form-control-label">Nama</label>
                            <input type="text" name="nama" placeholder="Enter role name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="nama" class=" form-control-label">Kode</label>
                            <input type="text" name="kode" placeholder="Enter role name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="nama" class=" form-control-label">Kode poin</label>
                            <input type="number" name="kode_poin" placeholder="Enter role name" class="form-control" step="any"  required>
                        </div>
                        <div class="form-group">
                        <label for="nama" class=" form-control-label">Klaster</label>
                        <select name="klaster">
                            @foreach($dataKlaster as $d)
                                <option value="{{$d->id}}">{{$d->nama}}</option>
                            @endforeach
                        </select>
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
    {{-- modal edit kategori --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="editModal" aria-labelledby="mediumModalLabel" style="display: none; padding-right: 17px;">
        <div class="modal-dialog" role="document">
            <div id='modalContent' class="modal-content">
               
            </div>
        </div>
    </div>

@endsection