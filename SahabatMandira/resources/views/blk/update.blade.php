@extends('layouts.index')

@section('title')
BLK
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
                <form method="POST" action="{{ route('blk.update',$blk->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Balai Latihan Kerja') }}</label>

                        <div class="col-md-12">
                            <input id="nama" type="nama" class="form-control @error('email') is-invalid @enderror"
                                name="nama" value="{{ $blk->nama }}" required autocomplete="nama" autofocus>

                            @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="alamat" class="col-md-12 col-form-label">{{ __('Alamat') }}</label>

                        <div class="col-md-12">
                            <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror"
                                name="alamat" value="{{ $blk->alamat }}" required autocomplete="alamat" autofocus>

                            @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="website" class="col-md-12 col-form-label">{{ __('Website Portofolio') }}</label>

                        <div class="col-md-12">
                            <input id="website" type="text" class="form-control @error('website') is-invalid @enderror"
                                name="website_portfolio" value="{{ $blk->website_portfolio }}" required
                                autocomplete="website" autofocus>

                            @error('website')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="memilikiSistem" class="col-md-12 col-form-label">{{ __('Memiliki Sistem') }}</label>

                        <div class="col-md-12">
                            <select class="form-select" aria-label="Default select example" name="is_punyasistem">
                                <option value="1" {{ $blk->is_punyasistem == 1 ? 'selected' : '' }}>YA</option>
                                <option value="0" {{ $blk->is_punyasistem == 0 ? 'selected' : '' }}>Tidak</option>
                            </select>

                            @error('memilikiSistem')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="linkPendaftaran"
                            class="col-md-12 col-form-label">{{ __('Link Pendaftaran') }}</label>

                        <div class="col-md-12">
                            <input id="linkPendaftaran" type="text"
                                class="form-control @error('linkPendaftaran') is-invalid @enderror"
                                name="link_pendaftaran" value="{{ $blk->link_pendaftaran }}" required
                                autocomplete="linkPendaftaran" autofocus>

                            @error('linkPendaftaran')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-0 rata_tengah">
                        <div class="col-md-12 offset-manual">
                            <button type="submit" class="btn btn-primary">
                                {{ __('EDIT') }}
                            </button>
                </form>
                <form action="{{ route('blk.destroy',$blk->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary">
                        {{ __('DELETE') }}
                    </button>
                </form>
                <br>
            </div>
        </div>

    </div>
</div>
</div>
@endsection
