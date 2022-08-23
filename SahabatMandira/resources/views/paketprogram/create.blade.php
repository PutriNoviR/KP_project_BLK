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
        <li class="breadcrumb-item active">BLK</li>
    </ol>
</div><!-- /.col -->
@endsection

@section('contents')
<div class="card-kelengkapan">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-register">
                <div class="card-header">
                    <h4>Tambah Program Kerja</h4>
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

                            {{-- <div class="col-md-12">
                                <input id="nama" type="nama" class="form-control @error('email') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus>

                                @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div> --}}

                            <div class="col-md-12">

                                <select class="form-control" aria-label="Default select example" name="name">
                                    <option value="1">BLK satu</option>
                                    <option value="0">BLK dua</option>
                                </select>

                                @error('website')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kejuruan" class="col-md-12 col-form-label">{{ __('Kejuruan') }}</label>

                            {{-- <div class="col-md-12">
                                <input id="kejuruan" type="text" class="form-control @error('alamat') is-invalid @enderror" name="kejuruan" value="{{ old('kejuruan') }}" required autocomplete="kejuruan" autofocus>

                                @error('kejuruan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div> --}}

                            <div class="col-md-12">

                                <select class="form-control" aria-label="Default select example" name="kejuruan">
                                    <option value="1">kejuruan satu</option>
                                    <option value="0">kejuruan dua</option>
                                </select>

                                @error('website')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="subKejuruan" class="col-md-12 col-form-label">{{ __('Sub Kejuruan') }}</label>

                            <div class="col-md-12">

                                <select class="form-control" aria-label="Default select example" name="subKejuruan">
                                    <option value="1">Sub kejuruan satu</option>
                                    <option value="0">Sub kejuruan dua</option>
                                </select>

                                @error('website')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="body-btn">
                            <button type="submit" class="btn btn-primary">
                                {{ __('SIMPAN') }}
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
