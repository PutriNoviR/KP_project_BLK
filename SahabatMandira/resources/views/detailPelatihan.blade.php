@if(Auth::user()->role->nama_role == 'peserta')
<div class="col-sm-6">
    <h2 class="m-0 text-dark">Detail Pelatihan</h2><br>
</div>
@foreach($ditawarkan as $d)
<div class="col-sm-3 float-left">
    <div class="card card-primary ">
        <div class="ribbon-wrapper">
            <div class="ribbon bg-primary">
                {{ $d->paketProgram->blk->nama }}
            </div>
        </div>
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
            <a data-toggle="modal" data-target="#modalTambahInstruktur" class='btn btn-warning '>
                DAFTAR PELATIHA
            </a>
        </div>
    </div>
</div>
@endforeach
@endif
