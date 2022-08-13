@extends('layouts.index')

@section('title')
Sub Kejuruan
@endsection

@section('page-bar')
<ul class="page-breadcrumb">
    <li>
        <i class="fa fa-home"></i>
        <a href="http://127.0.0.1:8000/">Dashboard</a>
        <i class="fa fa-angle-right"></i>
    </li>

    <li>
        <a href="http://127.0.0.1:8000/menu/kejuruan">BLK</a>
        <i class="fa fa-angle-right"></i>
    </li>
</ul>
@endsection

@section('contents')
<div class="row justify-content-center">

    <div class="col-md-8">
        <div class="card-register">
            <div class="card-header">
                <h4>Tambah Balai Latihan Kerja</h4>
            </div>
            @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
            @endif

            <div class="card-body">
                <form method="POST" action="{{ route('subkejuruan.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Sub Kejuruan') }}</label>

                        <div class="col-md-12">
                            <input id="nama" type="nama" class="form-control @error('email') is-invalid @enderror"
                                name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus>

                            @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="alamat" class="col-md-12 col-form-label">{{ __('Tipe Kejuruan') }}</label>

                        <div class="col-md-12">
                            <select class="form-select" aria-label="Default select example" name="kejuruans_id">
                                @foreach ($kejuruan as $k )
                                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                @endforeach
                            </select>

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
                            <br>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
