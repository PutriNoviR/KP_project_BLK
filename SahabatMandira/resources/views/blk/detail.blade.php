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

                <div class="form-group">
                    <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Balai Latihan Kerja') }}</label>

                    <div class="col-md-12">
                        <input id="nama" type="nama" class="form-control @error('email') is-invalid @enderror" name="nama" value="{{$blk->nama}}" disabled autocomplete="nama" autofocus>

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
                        <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{$blk->alamat}}" disabled autocomplete="alamat" autofocus>

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
                        <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website_portfolio" value="{{$blk->website_portfolio }}" disabled autocomplete="website" autofocus>

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
                        <input id="memilikiSistem" type="text" class="form-control @error('memilikiSistem') is-invalid @enderror" name="is_punyasistem" value="{{$blk->is_punyasistem }}" disabled autocomplete="memilikiSistem" autofocus>

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
                        <input id="linkPendaftaran" type="text" class="form-control @error('linkPendaftaran') is-invalid @enderror" name="link_pendaftaran" value="{{$blk->link_pendaftaran }}" disabled autocomplete="linkPendaftaran" autofocus>

                        @error('linkPendaftaran')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group my-3">
                    <div class="col-md-15 text-center">

                        <form method="POST" action="{{ url('menu/blk/'.$blk->id)}}">
                            <a href="{{ url('menu/blk/'.$blk->id.'/edit')}}" type="submit" class="btn btn-primary mr-5">
                                {{ __('UPDATE') }}
                            </a>
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