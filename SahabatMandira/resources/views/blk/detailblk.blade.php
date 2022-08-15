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
<div class="card-kelengkapan">
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

                <div class="portlet-body form">
                    <form method="POST" action="{{ route('blk.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Balai Latihan Kerja') }}</label>

                            <div class="col-md-12">
                                <input id="nama" type="nama" class="form-control @error('email') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus>

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
                                <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" required autocomplete="alamat" autofocus>

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
                                <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website_portfolio" value="{{ old('website') }}" required autocomplete="website" autofocus>

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
                                    <option value="1">YA</option>
                                    <option value="0">Tidak</option>
                                </select>

                                @error('memilikiSistem')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="linkPendaftaran" class="col-md-12 col-form-label">{{ __('Link Pendaftaran') }}</label>

                            <div class="col-md-12">
                                <input id="linkPendaftaran" type="text" class="form-control @error('linkPendaftaran') is-invalid @enderror" name="link_pendaftaran" value="{{ old('linkPendaftaran') }}" required autocomplete="linkPendaftaran" autofocus>

                                @error('linkPendaftaran')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="body-btn">
                            <button type="submit" class="btn btn-primary">
                                {{ __('EDIT') }}
                            </button>
                        </div>
                        <br>

                        <div class="body-btn">
                            <button type="button" class="btn btn-primary">
                                {{ __('DELETE') }}
                            </button>
                        </div>
                        <br>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection