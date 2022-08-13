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
                <h4>Tambah Kejuruan</h4>
            </div>
            @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
            @endif
            <div class="card-body">
                <form method="POST" action="{{ route('kejuruans.update',$Kejuruan->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Kejuruan') }}</label>

                        <div class="col-md-12">
                            <input id="nama" type="nama" class="form-control @error('email') is-invalid @enderror"
                                name="nama" value="{{ $Kejuruan->nama }}" required autocomplete="nama" autofocus>

                            @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="linkKejuruan"
                            class="col-md-12 col-form-label">{{ __('Link Kejuruan Test') }}</label>

                        <div class="col-md-12">
                            <input id="linkKejuruan" type="text"
                                class="form-control @error('linkKejuruan') is-invalid @enderror"
                                name="link_kejuruan_tes_2" value="{{ $Kejuruan->link_kejuruan_tes_2 }}">

                            @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-0 rata_tengah">
                        <div class="col-md-12 offset-manual">
                            <button type="submit" class="btn btn-primary">
                                {{ __('SIMPAN') }}
                            </button>
                </form>
                <form action="{{ route('kejuruans.destroy',$Kejuruan->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary">
                        {{ __('DELETE') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
