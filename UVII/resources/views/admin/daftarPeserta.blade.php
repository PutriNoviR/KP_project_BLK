@extends('layouts.index',['menu'=>$menu_role])

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
            <a href="{{route('home')}}">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>

        <li>
            <a href="{{route('peserta.index')}}">Peserta</a>
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
        <a href="{{route('export.listPeserta')}}" class='btn btn-xs btn-success'><i class="fa fa-print"></i> Export to Excel</a>
      {{--  <a href="{{route('daftar_peserta.cetak')}}" class='btn btn-xs btn-danger'><i class="fa fa-print"></i> Export to PDF</a><br><br>--}}
        <a href="{{route('export.cetakPeserta')}}" target=_blank class='btn btn-xs btn-danger'><i class="fa fa-print"></i> Export to PDF</a><br><br>

            <table class="table table-striped table-bordered table-hover dataTable no-footer display responsive" id="sample_1" role="grid" aria-describedby="sample_1_info" style="width:100%">
                <thead>
                <tr role="row">
                    <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
                        aria-label="Rendering engine: activate to sort column ascending">
                        No
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
                        aria-label="Browser: activate to sort column ascending">
                        Nama Lengkap
                    </th>
                    <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
                        aria-label="Rendering engine: activate to sort column ascending">
                        Email
                    </th>
                    <th  class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
                        aria-label="Rendering engine: activate to sort column ascending">
                        No Handphone
                    </th>
                    <th  class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
                        aria-label="Rendering engine: activate to sort column ascending">
                        Klaster Psikometrik
                    </th>
                    <th  class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
                        aria-label="Rendering engine: activate to sort column ascending">
                        Kategori Psikometrik
                    </th>
                    <th  class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
                        aria-label="Rendering engine: activate to sort column ascending">
                        Jumlah Sesi
                    </th>
                    <th  class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
                        aria-label="Rendering engine: activate to sort column ascending">
                        Detail
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

                    @foreach($hasil as $key=>$d)
                   
                    <tr role="row" class="{{ ($key % 2 === 0) ? 'active' : 'success' }}">
                        <td>
                            {{$no}}
                        </td>
                        <td>
                            {{$d['nama_depan']." ".$d['nama_belakang']}}
                        </td>
                        <td>
                            {{$d['email']}}
                        </td>
                        <td>
                            {{$d['No.Hp']}}
                        </td>

                        <td>
                            {{$d['klaster']}}
                        </td>
                        <td>
                            {{$d['kategori']}}
                        </td>
                        <td>
                            {{$d['jumsesi']}}
                        </td>
                        <td>
                            <a data-toggle='modal' data-target="#modal_{{$d['username']}}" class="btn btn-default btn-xs btn-info"><i class="fa fa-eye"></i> View</a>
                        </td>
                        <td>
                            <a onclick="getEditForm('{{ $d['email']}}')" data-toggle='modal' data-target='#editModal' class="btn btn-default btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>
                           
                            <a class="btn btn-default btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal_{{$d['username']}}">
                                <i class="fa fa-trash-o"></i> Hapus
                            </a>
                            
                            <form method='POST' action="{{ url('menu/peserta/'.$d['email']) }}">
                                @csrf
                                @method('DELETE')
                                <div id="deleteModal_{{$d['username']}}" class="modal fade" tabindex="-1" role="basic">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body" style="text-align: center;">
                                                <div style="width: 60px; height: 60px; margin: auto;">
                                                    <i style="font-size: 46px; color: #8a6d3b; margin-top: 10px;" class="glyphicon glyphicon-warning-sign"></i>
                                                </div>
                                                <p>
                                                    Apakah Anda yakin ingin menghapus data <b>{{$d['username']}}</b>?
                                                </p>
                                                <input type='hidden' name='email' value="{{ $d['email'] }}">
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

                    <div class="modal fade" id="modal_{{$d['username']}}" tabindex="-1" role="basic" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><i style="font-size: 20px" class="fa fa-user"></i> {{$d['username']}}</h4>
                                    <small>{{$d['email']}}</small>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Jenis Kelamin</label>
                                        <input name="jenis_kelamin" class="form-control" disabled value="{{$d['jenis_kelamin']}}">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Pendidikan Terakhir</label>
                                        <input name="pendidikan" class="form-control" disabled value="{{$d['pendidikan']}}">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">kewarganegaraan</label>
                                        <input name="kewarganegaraan" class="form-control" disabled value="{{$d['jenis_identitas']== 'Pasport'? 'Warga Negara Asing':'Warga Negara Indonesia'}}">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Alamat</label>
                                        <input name="alamat" class="form-control" disabled value="{{$d['alamat']}}">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Kota</label>
                                        <input name="kota" class="form-control" disabled value="{{$d['kota']}}">
                                    </div>
            
                                    {{--<div class="form-group">
                                        <label class="col-sm-4 control-label">Nomor Identitas</label>
                                        <input name="nomor_identitas" class="form-control" disabled value="{{$d['nomor_identitas']}}">
                                    </div>--}}
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

    {{-- modal edit role --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="editModal" aria-labelledby="mediumModalLabel" style="display: none; padding-right: 17px;">
        <div class="modal-dialog" role="document">
            <div id='modalContent' class="modal-content">
               
            </div>
        </div>
    </div>


                

@endsection