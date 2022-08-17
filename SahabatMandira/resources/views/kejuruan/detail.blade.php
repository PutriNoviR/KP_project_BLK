@extends('layouts.index')

@section('title')
Kejuruan
@endsection

@section('page-bar')
<ul class="page-breadcrumb">
    <li>
        <i class="fa fa-home"></i>
        <a href="http://127.0.0.1:8000/">Dashboard</a>
        <i class="fa fa-angle-right"></i>
    </li>

    <li>
        <a href="http://127.0.0.1:8000/menu/kejuruans">Kejuruan</a>
        <i class="fa fa-angle-right"></i>
    </li>
</ul>
@endsection

@section('contents')
<div class="row justify-content-center">

    <div class="col-md-8">
        <div class="card-register">
            <div class="card-header">
                <h4>Detail Kejuruan</h4>
            </div>

            <div class="card-body">
                @csrf

                <div class="form-group">
                    <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Kejuruan') }}</label>

                    <div class="col-md-12">
                        <input id="nama" type="nama" class="form-control @error('email') is-invalid @enderror" name="nama" value="{{$data->nama }}" disabled autocomplete="nama" autofocus>

                        @error('nama')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="linkKejuruan" class="col-md-12 col-form-label">{{ __('Link Kejuruan Test') }}</label>

                    <div class="col-md-12">
                        <input id="linkKejuruan" type="text" class="form-control @error('linkKejuruan') is-invalid @enderror" name="link_kejuruan_tes_2" value="{{$data->link_kejuruan_tes_2 }}" disabled autocomplete="linkKejuruan" autofocus>

                        @error('alamat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group mb-0 rata_tengah">
                    <div class="col-md-12 offset-manual">
                        <a href="{{ url('menu/kejuruans/'.$data->id.'/edit')}}" type="submit" class="btn btn-primary">
                            {{ __('UPDATE') }}
                        </a>
                        <form method="POST" action="{{ url('menu/kejuruans/'.$data->id)}}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="DELETE" class="btn btn-danger" onclick="if(!confirm('are you sure to delete this record ?')) return false;">
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection