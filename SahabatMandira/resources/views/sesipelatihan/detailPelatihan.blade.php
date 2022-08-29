@extends('layouts.adminlte')

@section('title')
PELATIHAN
@endsection

@section('contents')
<div class="col-sm-6">
    <h2 class="m-0 text-dark">Detail Program Pelatihan</h2><br>
</div>
@foreach($data as $d)
<div class="col-sm-3">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $d->paketProgram->kejuruan->nama }}</h3>
        </div>

        <div class="card-body">
            <h2>Kejuruan :</h2>
            {{ $d->paketProgram->kejuruan->nama }}
        </div>
        <div class="card-body">
            <h2>Sub Kejuruan :</h2>
            {{ $d->paketProgram->subkejuruan->nama }}
        </div>
        <div class="card-body">
            <h2>Deskripsi :</h2>
            <h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat.</h5>
        </div>
        <div class="card-footer">
            @if(Auth::user()->nomor_identitas == null)
            <a href="{{url('pelatihanPeserta/lengkapiBerkas/'.$d->id)}}"
                class="button btn btn-warning">{{ __('DAFTAR')}}</a>
            @else
            <form method="POST" action="{{ route('pelatihanPesertas.storePendaftar',$d->id) }}">
                @csrf
                <input type="hidden" name="status" class="col-md-12 col-form-label" value="terdaftar">
                <input type="hidden" name="tanggal_seleksi" class="col-md-12 col-form-label"
                    value="{{ $d->tanggal_seleksi }}">
                <button type="submit" class="button btn btn-info">{{ __('DAFTAR')}}</button>
            </form>
            @endif
        </div>
    </div>
</div>
@endforeach
@endsection
