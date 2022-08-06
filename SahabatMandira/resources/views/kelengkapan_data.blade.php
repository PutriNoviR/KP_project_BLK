@extends('layouts.index')

@section('title')
    Dashboard
@endsection

@section('page-bar')
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="http://127.0.0.1:8000/">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>
    </ul>
@endsection

@section('contents')
<div class="card-kelengkapan">

    <div class="card-header">
        <p>Kelengkapan Dokumen</p>
    </div>

    <div class="portlet-body form">

        <form role='form' method="POST" enctype="multipart/form-data" action="{{ route('pengguna.data.dokumen') }}">
            @csrf
            <div class="form-body">
                <div class="form-group">
                    <label for="pas_foto">Pas Foto</label>
                    
                    <input type="file" name='pas_foto' class="defaults" value="{{ $data->pas_foto ?? ''}}" required>
                </div>

                <div class="form-group">
                    <label for="ktp">Dokumen KTP</label>
                    
                    <input type="file" name='no_ktp' class="defaults" value="{{ $data->ktp ?? ''}}" required>
                </div>

                <div class="form-group">
                    <label for="ksk">Dokumen KSK</label>
                    
                    <input type="file" name='ksk' class="defaults" value="{{ $data->ksk ?? ''}}" required> 
                </div>

                <div class="form-group">
                    <label for="ijazah">Dokumen Ijazah</label>
                    
                    <input type="file" name='ijazah' class="defaults" value="{{ $data->ijazah ?? ''}}" required>
                </div>

                <div class="form-group form-button">
                    <div class="row">
                        <div class="col-md-6 pull-right">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Submit') }}
                            </button>
                        </div>

                        <div class="col-md-6 pull-left">
                            <a class="col-md-8 btn btn-primary" href="{{ route('home') }}">
                                {{ __('Back') }}
                            </a>
                        </div>
                    </div>
                </div>
                
            </div>
        
        </form>
    </div>

</div>
@endsection