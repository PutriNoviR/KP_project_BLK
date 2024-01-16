@foreach ($lowongans as $lowongan)
    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
        <div class="card bg-light w-100">
            <div class="card-header border-bottom-0 text-primary">
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-7">
                        <h1 class="lead"><b>{{ $lowongan->posisi }}</b></h1>
                        <h6 class="text-muted">{{ $lowongan->perusahaan->nama }}</h6>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small"><span class="fa-li">
                                    <i class="fas fa-briefcase"></i></span> Bidang:
                                {{ $lowongan->bidang_kerja->nama_bidang }}</li>
                        </ul>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Kota:
                                {{ $lowongan->kota }}</li>
                        </ul>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Alamat:
                                {{ $lowongan->perusahaan->alamat }}</li>
                        </ul>


                        <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small"><span class="fa-li"><i class="fa fa-calendar"></i></span> Tanggal
                                Dibuat:
                                {{ $lowongan->tanggal_pemasangan }}</li>
                        </ul>

                        <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small"><span class="fa-li"><i class="fa fa-user"></i></span>
                                Jumlah Pelamar:
                                {{ count($lowongan->lamaran) }}</li>
                        </ul>
                    </div>
                    <div class="col-5 text-center">
                        <img src="{{ asset('storage/' . $lowongan->perusahaan->logo) }} " alt=""
                            class="img-circle img-fluid">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="text-right">
                    <a href="{{ route('lowongan.show', $lowongan->id) }}" class="btn btn-sm btn-primary">
                        Apply
                    </a>
                </div>
            </div>
        </div>
    </div>

@endforeach

@if (count($lowongans) < 1)
    <p style="text-align: center; width:100% ; ">Data Tidak Ditemukan.</p>
@endif
