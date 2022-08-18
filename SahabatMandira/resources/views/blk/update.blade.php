@extends('layouts.adminlte')

@section('title')
BLK
@endsection

@section('page-bar')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">BLK</h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{url('menu/blk')}}">BLK</a></li>
    </ol>
</div><!-- /.col -->
@endsection

@section('contents')
<div class="row justify-content-center">

    <div class="col-md-10">
        <div class="card-register">
            <div class="card-header">
                <h4>Edit Balai Latihan Kerja</h4>
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
                            <input id="nama" type="nama" class="form-control @error('email') is-invalid @enderror" name="nama" value="{{ $blk->nama }}" required autocomplete="nama" autofocus>

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
                            <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ $blk->alamat }}" required autocomplete="alamat" autofocus>

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
                            <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website_portfolio" value="{{ $blk->website_portfolio }}" required autocomplete="website" autofocus>

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
                        <label for="linkPendaftaran" class="col-md-12 col-form-label">{{ __('Link Pendaftaran') }}</label>

                        <div class="col-md-12">
                            <input id="linkPendaftaran" type="text" class="form-control @error('linkPendaftaran') is-invalid @enderror" name="link_pendaftaran" value="{{ $blk->link_pendaftaran }}" required autocomplete="linkPendaftaran" autofocus>

                            @error('linkPendaftaran')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group my-3">
                        <div class="col-md-15 text-center">
                            <button type="submit" class="btn btn-lg btn-primary">
                                {{ __('SIMPAN') }}
                            </button>
                        </div>
                    </div>
                </form>
                <br>
            </div>
        </div>

    </div>
</div>
@endsection