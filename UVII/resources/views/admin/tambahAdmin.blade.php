@extends('layouts.index',['menu' => $menu_role])

@section('title')
    Tambah Admin
@endsection
@section('javascript')
<script>
    function getEditAdmin(id)
    {
        $.ajax({
            type:'POST',
            url:'{{route("admin.edit")}}',
            data:{'_token':'<?php echo csrf_token() ?>',
                'email':id
            },
            success: function(data){
               
                $('#modalContent').html(data.msg);
            }
        });
    }
  
    function passwordMinimumValidation(id){
        var pass = $(id).val().trim();
        var number = /([0-9])/;
        var alphabets = /([A-Z])/;
        var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;

        if(pass.length >= 8){
            $('#passKarakter').css('color','green');

            if(pass.match(number)){
                $('#passAngka').css('color','green');
            }

            if(pass.match(alphabets)){    
                $('#passKapital').css('color','green');

            }
            
            if(pass.match(special_characters)) {
                $('#passSimbol').css('color','green');
            } 
        }

        else{
            $('#passKarakter').css('color','red');

            $('#passAngka').css('color','red');
            
            $('#passSimbol').css('color','red');

            $('#passKapital').css('color','red');
        }
        
    }

    $('#togglePass').click(function(){
        var tipe = $('#mypass').attr('type');
        $(this).removeClass();

        if(tipe == 'password'){
            $('#mypass').attr('type', 'text');
           
            $(this).addClass('fa fa-eye-slash');
        }
        else{
            $('#mypass').attr('type', 'password');
      
            $(this).addClass('fa fa-eye');
        }
     
    });

    $('#toggleConfirmPass').click(function(){
        var tipe = $('#password-confirm').attr('type');
        $(this).removeClass();

        if(tipe == 'password'){
            $('#password-confirm').attr('type', 'text');
           
            $(this).addClass('fa fa-eye-slash');
        }
        else{
            $('#password-confirm').attr('type', 'password');
      
            $(this).addClass('fa fa-eye');
        }
     
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
            <a href="{{route('admin.show')}}">Admin</a>
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

    <a data-target='#tambahModal' data-toggle='modal' class='btn btn-xs btn-success'><i class="fa fa-plus"></i> Tambah Admin</a><br><br>

    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">
                List Admin
            </div>
        </div>
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
                            No Telepon
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
                            aria-label="Browser: activate to sort column ascending">
                            Email
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

                    @foreach($data as $key=>$d)
                    <tr role="row" class="{{ ($key % 2 === 0) ? 'active' : 'success' }}">
            
                        <td>
                            {{$no}}
                        </td>
                        <td>
                            {{$d->nama_depan}} {{$d->nama_belakang}}
                        </td>
                        <td>
                            {{$d->nomer_hp}}
                        </td>
                        <td>
                            {{$d->email}}
                        </td>
                        <td>
                            <a data-toggle='modal' data-target='#modal_{{$d->username}}' class="btn btn-default btn-xs btn-info"><i class="fa fa-eye"></i> View</a>
                            <a onclick="getEditAdmin('{{ $d->email }}')" data-toggle='modal' data-target='#editModal' class="btn btn-default btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>
                            
                            <a class="btn btn-default btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal_{{$d->username}}">
                                <i class="fa fa-trash-o"></i> Hapus
                            </a>
                            
                            <form method='POST' action="{{ route('admin.delete') }}">
                                @csrf
                                <div id="deleteModal_{{$d->username}}" class="modal fade" tabindex="-1" role="basic">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body" style="text-align: center;">
                                                <div style="width: 60px; height: 60px; margin: auto;">
                                                    <i style="font-size: 46px; color: #8a6d3b; margin-top: 10px;" class="glyphicon glyphicon-warning-sign"></i>
                                                </div>
                                                <p>
                                                    Apakah Anda yakin ingin menghapus data ?
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
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Nomer Handphone</label>
                                        <input name="alamat" class="form-control" disabled value='{{$d->nomer_hp}}'>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Email</label>
                                        <input name="nomor_identitas" class="form-control" disabled value='{{$d->email}}'>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Kota</label>
                                        <input name="alamat" class="form-control" disabled value='{{$d->kota}}'>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Alamat</label>
                                        <input name="nomor_identitas" class="form-control" disabled value='{{$d->alamat}}'>
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

    {{-- modal tambah Admin --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="tambahModal" aria-labelledby="mediumModalLabel" style="display: none; padding-right: 17px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>    
                
                    <h5 class="modal-title" id="mediumModalLabel"><strong>Tambah Admin</strong></h5>   
                </div>
                
                <form class="register-form" method="POST" action="{{route('admin.tambah')}}">
                        @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="nama_depan" class=" form-control-label">Nama Depan</label>
                                <input type="text" name="nama_depan" placeholder="Enter your firstname" class="form-control" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="nama_belakang" class=" form-control-label">Nama Belakang</label>
                                <input type="text" name="nama_belakang" placeholder="Enter your lastname" class="form-control" required>
                            </div>
                        </div>
                   
                        <div class="form-group">
                            <label>No.Handphone</label>
                            <input name="no_hp" type='text' class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" type='email' class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Username</label>
                            <input name="username" type='text' class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <i class="fa fa-eye" id='togglePass'></i>
                            <input id='mypass' name="password" type='password' class="form-control" required onKeyUp='passwordMinimumValidation(this)'>
                            <span class="password-minimum">Minimum Password :</span>
                            <span id='passKarakter' class="password-minimum">8 Karakter</span>
                            <span id='passAngka' class="password-minimum">1 Angka</span>
                            <span id='passKapital' class="password-minimum">1 Huruf Kapital</span>
                            <span id='passSimbol' class="password-minimum">1 Simbol</span><br>

                        </div>

                        <div class="form-group">
                            <br><label>Confirm Password</label>
                            <i class="fa fa-eye" id='toggleConfirmPass'></i>
                            <input id='password-confirm' name="password_confirmation" type='password' class="form-control" required>
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
